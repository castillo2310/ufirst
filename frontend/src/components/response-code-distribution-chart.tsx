import { Log } from '@/app/log';
import 'chart.js/auto';
import { Doughnut } from 'react-chartjs-2';

export default function ResponseCodeDistributionChart({ logs }: { logs: Array<Log> }) {

    function generateData(data: Array<Log>): any {
        const responseCodes: any = {};

        data.forEach(log => {
            const responseCode = log.response_code;
            if (!responseCodes[responseCode]) {
                responseCodes[responseCode] = 1;
            } else {
                responseCodes[responseCode]++;
            }
        }) 

        const labels = Object.keys(responseCodes);
        const values = Object.values(responseCodes);
        
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
            text: 'Distribution of HTTP answer codes'
          }
        }
      };


    return (
        <Doughnut data={data} options={options}/>
      )
}