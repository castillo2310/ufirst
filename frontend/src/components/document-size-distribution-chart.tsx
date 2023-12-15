import { Log } from '@/app/log';
import 'chart.js/auto';
import { Bar } from 'react-chartjs-2';

export default function DocumentSizeDistributionChart({ logs }: { logs: Array<Log> }) {

    function generateData(data: Array<Log>): any {
        const sizeRanges = {
            '0-200': 0,
            '201-400': 0,
            '401-600': 0,
            '601-800': 0,
            '801-1000': 0
          };
      
          data.forEach(log => {
              if (log.response_code !== 200 ||  log.document_size === null || log.document_size >= 1000) {
                  return;
              }
      
              if (log.document_size <= 200) sizeRanges['0-200']++;
              else if (log.document_size <= 400) sizeRanges['201-400']++;
              else if (log.document_size <= 600) sizeRanges['401-600']++;
              else if (log.document_size <= 800) sizeRanges['601-800']++;
              else if (log.document_size < 1000) sizeRanges['801-1000']++;
            
          });
      
          const labels = Object.keys(sizeRanges);
          const values = Object.values(sizeRanges);
      
          return {
            labels: labels,
            datasets: [{
              data: values,
              backgroundColor: [
                'rgba(255, 99, 132)',
                'rgba(54, 162, 235)',
                'rgba(255, 206, 86)',
                'rgba(75, 192, 192)',
                'rgba(153, 102, 255)',
              ]
            }]
          };
    }

    const data = generateData(logs);
    const options = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          title: {
            display: true,
            text: 'Distribution of HTTP request document sizes'
          },
          legend: {
            display: false 
          }
        }
      };


    return (
        <Bar data={data} options={options}/>
      )
}