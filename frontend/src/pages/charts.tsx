import { useEffect, useState } from 'react';
import Link from 'next/link';


import MethodsDistributionChart from '@/components/methods-distribution-chart';
import ResponseCodeDistributionChart from '@/components/response-code-distribution-chart';
import RequestsPerMinuteChart from '@/components/requests-per-minute-chart';
import DocumentSizeDistributionChart from '../components/document-size-distribution-chart';


export default function Charts() {
    const [data, setData] = useState(null);
    const [isLoading, setLoading] = useState(true)

    useEffect(() => {
      fetch('http://localhost:8099/log')
        .then((res) => res.json())
        .then((data) => {
          setData(data)
          setLoading(false)
        })
    }, [])

    if (isLoading) return <p>Loading...</p>
    if (!data) return <p>No data available</p>


    return (
      <main className="flex min-h-screen flex-col items-center justify-between">
        <div className="container mx-auto p-4 w-full">
          <div className="grid md:grid-cols-2 gap-4 mb-4">
            <div className="p-4 shadow rounded-lg bg-white h-96 w-full">
              <MethodsDistributionChart logs={data}/>
            </div>

            <div className="p-4 shadow rounded-lg bg-white h-96 w-full">
              <ResponseCodeDistributionChart logs={data}/>
            </div>
          </div>

          <div className="grid md:grid-cols-2 gap-4 mb-4">
            <div className="p-4 shadow rounded-lg bg-white h-96 w-full">
              <RequestsPerMinuteChart logs={data} />
            </div>

            <div className="p-4 shadow rounded-lg bg-white h-96 w-full">
              <DocumentSizeDistributionChart logs={data} />
            </div>
          </div>

          <div className="text-center mt-4">
            <Link href="/upload">
              <a className="text-blue-600 hover:text-blue-800 transition duration-300">
                Upload another file
              </a>
            </Link>
          </div>

        </div>  
      </main>
    )
}