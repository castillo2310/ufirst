/** @type {import('next').NextConfig} */
const nextConfig = {
  async redirects() {
    return [
      {
        source: '/',
        destination: '/upload',
        permanent: true,
      },
    ]
  },
}

module.exports = nextConfig
