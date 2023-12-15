import React, { useState, FormEvent, ChangeEvent } from 'react'
import { useRouter } from 'next/router';

export default function Upload() {
    const [isLoading, setIsLoading] = useState<boolean>(false);
    const [file, setFile] = useState<File | null>();
    const router = useRouter();

    const apiBaseUrl = process.env.NEXT_PUBLIC_API_BASE_URL;
    const url = apiBaseUrl+'/log';

    async function base64EncodeFile(file: File): Promise<string> {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();
        
            reader.onload = () => {
              resolve(String(reader.result));
            };
        
            reader.onerror = (error) => {
              reject(error);
            };
        
            reader.readAsDataURL(file);
          });
    }

    async function onSubmit(event: FormEvent<HTMLFormElement>) {
        event.preventDefault()
     
        try {
            if (!file) {
                return;
            }

            setIsLoading(true);

            const encodedFile = await base64EncodeFile(file);

            const response = await fetch(url, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({content: encodedFile.split(',').pop()})
            });
     
            if (!response.ok) {
                throw new Error('Error uploading the file.');
            }

            router.push('/charts');
        } catch (error) {
            console.error(error)
        } finally {
            setIsLoading(false) 
        }
    }

    function handleChange(event: ChangeEvent<HTMLInputElement>) {
        if (!event.target.files?.length) {
            return;
        }

        setFile(event.target.files[0]);    
    }

    return (
        <main className="flex min-h-screen flex-col items-center justify-between">
            <div className="relative flex place-items-center min-h-screen">
                <form onSubmit={onSubmit}>
                    <input className='bg-gray-200 shadow-inner rounded-l p-1 ' id='file-upload' type='file' accept=".txt"
                    onChange={handleChange}/>
                    <button className='bg-blue-600 hover:bg-blue-700 duration-300 text-white shadow p-2 rounded-r' type='submit'
                    disabled={isLoading}>
                        {isLoading ? 'Loading...' : 'Upload file'}
                    </button>
                </form>
            </div>
        </main>
      )
}