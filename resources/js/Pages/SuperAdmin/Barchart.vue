<template>
  <div class="col-span-full xl:col-span-6 bg-white shadow-lg rounded-sm border border-gray-200">
    <header class="px-5 py-4 border-b border-gray-100">
      <h2 class="font-semibold text-gray-800">Reason for Refunds</h2>
    </header>
    <div class="px-5 py-3">
      <div class="flex items-start">
        <div class="text-3xl font-bold text-gray-800 mr-2">449</div>
        <div class="text-sm font-semibold text-white px-1.5 bg-yellow-500 rounded-full">-22%</div>
      </div>
    </div>
    <!-- Chart built with Chart.js 3 -->
    <div class="grow">
      <!-- Change the height attribute to adjust the chart height -->
      <BarChart :data="chartData" :width="595" :height="48" />
    </div>
  </div>
</template>

<script>
import { BarChart } from 'vue-chartjs'
import { Chart as ChartJS, registerables } from 'chart.js'

// Import utilities

ChartJS.register(...registerables)
export default {
  components: {
    BarChart,
  },
  data(){
        return{
            data: {
                labels: ['Reasons'],
      datasets: [
        {
          label: 'Having difficulties using the product',
          data: [131],
          backgroundColor: '#036e15',

          barPercentage: 1,
          categoryPercentage: 1,
        },
        {
          label: 'Missing features I need',
          data: [100],
          backgroundColor: '#6875F5',

          barPercentage: 1,
          categoryPercentage: 1,
        },
        {
          label: 'Not satisfied about the quality of the product',
          data: [81],
          backgroundColor: '#bf0702',

          barPercentage: 1,
          categoryPercentage: 1,
        },
        {
          label: 'The product doesn’t look as advertised',
          data: [65],
          backgroundColor: '#875f5f',

          barPercentage: 1,
          categoryPercentage: 1,
        },
      ],
            },


        }
    },
}
</script>
