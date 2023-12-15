import type { AppProps } from 'next/app'
import type { Metadata } from 'next'

import '../app/globals.css'

 
export default function MyApp({ Component, pageProps }: AppProps) {
  return <Component {...pageProps} />
}
