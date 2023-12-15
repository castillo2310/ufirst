import { Log } from '@/app/log';
import 'chart.js/auto';
import { Line } from 'react-chartjs-2';
import 'chartjs-adapter-moment';

export default function RequestsPerMinuteChart({ logs }: { logs: Array<Log> }) {

    function generateData(data: Array<Log>): any {
        const minutes: any = {};
        const days = new Set();

        data.forEach(log => {
            const { day, hour, minute } = log.datetime;
            const timeKey = `2023-01-01T${hour}:${minute}`;

            if (!minutes[timeKey]) {
                minutes[timeKey] = 0;

                if (!days.has(day)) {
                    days.add(day);
                } 
            }

            minutes[timeKey]++;
        }) 


        const labels = Object.keys(minutes).sort();
        const values = labels.map(key => {
        const average = minutes[key] / days.size;
        return average;
        });
        
        return {
        labels: labels,
        datasets: [{
            data: values,
            pointRadius: 0,
            borderWidth: 1,
            tension: 0.1,
        }],  
        };
    }


    const data = generateData(logs);
    const options: any = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          title: {
            display: true,
            text: 'HTTP Requests per minute'
          },
          legend: {
            display: false 
          }
        },
        scales: {
          x: {
            type: 'time',
            time: {
              unit: 'minute',
              displayFormats: {
                minute: 'HH:mm'
              }
            },
            ticks: {
              major: {
                enabled: true
              }
            }
          },
          y: {
            beginAtZero: true 
          }
        },  
      };


    return (
        <Line data={data} options={options}/>
      )
}