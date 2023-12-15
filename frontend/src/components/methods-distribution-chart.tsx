import { Log } from '@/app/log';
import 'chart.js/auto';
import { Doughnut } from 'react-chartjs-2';

export default function MethodsDistributionChart({ logs }: { logs: Array<Log> }) {

    function generateData(data: Array<Log>): any {
        const methods: any = {'Invalid': 0};

        data.forEach(log => {
            const method = log.request.method;
            if (!method) {
                methods['Invalid']++;
            } else if (!methods[method]) {
                methods[method] = 1;
            } else {
              methods[method]++;
            }
        }) 

        const labels = Object.keys(methods);
        const values = Object.values(methods);

        return {
          labels: labels,
          datasets: [{
            data: values,
            hoverOffset: 4
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
            text: 'Distribution of HTTP methods'
          }
        }
      }


    return (
        <Doughnut data={data} options={options}/>
      )
}