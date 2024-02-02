import React, { useEffect } from 'react';
import Chart from 'chart.js/auto'; // Import Chart.js

import './dashboard.css'; // Make sure to import the corresponding CSS file
import HeaderAndSidebar from '../../components/headerAndSidebar/HeaderAndSidebar';

const Dashboard = () => {
  useEffect(() => {
    // Sample data for the line chart
    const pm25Data = {
      labels: ['January', 'February', 'March', 'April', 'May'],
      datasets: [{
        label: 'Monthly Sales',
        data: [12, 19, 3, 5, 2],
        fill: false,
        borderColor: 'rgba(75, 192, 192, 1)',
        tension: 0.1,
      }]
    };

    // Sample data for PM10 chart
    const pm10Data = {
      labels: ['January', 'February', 'March', 'April', 'May'],
      datasets: [{
        label: 'Monthly Sales',
        data: [8, 15, 5, 10, 3],
        fill: false,
        borderColor: 'rgba(255, 99, 132, 1)',
        tension: 0.1,
      }]
    };

    // Sample data for CO2 chart
    const co2Data = {
      labels: ['January', 'February', 'March', 'April', 'May'],
      datasets: [{
        label: 'Monthly Sales',
        data: [20, 25, 10, 18, 12],
        fill: false,
        borderColor: 'rgba(255, 206, 86, 1)',
        tension: 0.1,
      }]
    };

    // Sample data for NO2 chart
    const no2Data = {
      labels: ['January', 'February', 'March', 'April', 'May'],
      datasets: [{
        label: 'Monthly Sales',
        data: [5, 8, 2, 7, 4],
        fill: false,
        borderColor: 'rgba(153, 102, 255, 1)',
        tension: 0.1,
      }]
    };

    // Configuration options
    const options = {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    };

    // Get the chart container elements
    const pm25ChartContainer = document.getElementById('chartGraphPM25');
    const pm10ChartContainer = document.getElementById('chartGraphPM10');
    const co2ChartContainer = document.getElementById('chartGraphCO2');
    const no2ChartContainer = document.getElementById('chartGraphNO2');

    // Function to create a line chart
    const createLineChart = (container, data, label, borderColor) => {
      return new Chart(container, {
        type: 'line',
        data: {
          labels: data.labels,
          datasets: [{
            label: label,
            data: data.datasets[0].data,
            fill: false,
            borderColor: borderColor,
            tension: 0.1,
          }]
        },
        options: options
      });
    };

    // Create line charts
    const pm25Chart = createLineChart(pm25ChartContainer, pm25Data, 'PM2.5', 'rgba(75, 192, 192, 1)');
    const pm10Chart = createLineChart(pm10ChartContainer, pm10Data, 'PM10', 'rgba(255, 99, 132, 1)');
    const co2Chart = createLineChart(co2ChartContainer, co2Data, 'CO2', 'rgba(255, 206, 86, 1)');
    const no2Chart = createLineChart(no2ChartContainer, no2Data, 'NO2', 'rgba(153, 102, 255, 1)');
    


    // Cleanup function
    return () => {
      // Destroy existing charts
      pm25Chart.destroy();
      pm10Chart.destroy();
      co2Chart.destroy();
      no2Chart.destroy();
    };
  }, []); // Run this effect once when the component mounts

  
  return (
    <div>
      <HeaderAndSidebar/>

      <section className="employees">
        <h1 className="heading">Predicted Outcome</h1>
        <div className="box-container">
          {/* Box 2 */}
          <div className="box">
            <h3 className="title">PM2.5</h3>
            <div className="circle"> </div>
            <p className="outcome">Good</p>
          </div>
          {/* Box 2 */}
          <div className="box">
            <h3 className="title">PM10</h3>
            <div className="circle"> </div>
            <p className="outcome">Bad</p>
          </div>
          {/* Box 2 */}
          <div className="box">
            <h3 className="title">CO2</h3>
            <div className="circle"> </div>
            <p className="outcome">Good</p>
          </div>
          {/* Box 2 */}
          <div className="box">
            <h3 className="title">NO2</h3>
            <div className="circle"> </div>
            <p className="outcome">Good</p>
          </div>
        </div>
      </section>



      <section className="quick-select">
        <h1 className="heading">overview</h1>
        <div className="box-container">
          <div className="box">
              <div className="chartNameContainer">
                <a href="#"><i className="fas fa-code"></i><span>PM2.5</span></a>
              </div>
              <div className="chartGraphContainer">
                <div className="chartGraph">
                  <canvas id="chartGraphPM25" width="400" height="200"></canvas>

                </div>
              </div>
              
          </div>
          <div className="box">
              <div className="chartNameContainer">
                <a href="#"><i className="fas fa-code"></i><span>PM10</span></a>
              </div>
              <div className="chartGraphContainer">
                <div className="chartGraph">
                  <canvas id="chartGraphPM10" width="400" height="200"></canvas>
                </div>
              </div>
              
          </div>
          <div className="box">
              <div className="chartNameContainer">
                <a href="#"><i className="fas fa-code"></i><span>Co2</span></a>
              </div>
              <div className="chartGraphContainer">
                <div className="chartGraph">
                  <canvas id="chartGraphCO2" width="400" height="200"></canvas>
                </div>
              </div>
              
          </div>
          <div className="box">
              <div className="chartNameContainer">
                <a href="#"><i className="fas fa-code"></i><span>NO2</span></a>
              </div>
              <div className="chartGraphContainer">
                <div className="chartGraph">
                  <canvas id="chartGraphNO2" width="400" height="200"></canvas>
                </div>
              </div>
              
          </div>
        </div>
      </section>



    </div>
  );
};

export default Dashboard;