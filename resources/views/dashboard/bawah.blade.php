<!-- Budget Report -->
        <div class="col-lg-6">
          <div class="card">
            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>
                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>
            <div class="card-body pb-0">
              <h5 class="card-title">Budget Report <span>| This Month</span></h5>
              <div id="budgetChart" style="height: 300px;" class="echart"></div>
            </div>
          </div>
        </div>

        <!-- Website Traffic -->
        <div class="col-lg-6">
          <div class="card">
            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>
                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>
            <div class="card-body pb-0">
              <h5 class="card-title">Website Traffic <span>| Today</span></h5>
              <div id="trafficChart" style="height: 300px;" class="echart"></div>
            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Line Chart</h5>

              <!-- Line Chart -->
              <canvas id="lineChart" style="max-height: 400px;"></canvas>
              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new Chart(document.querySelector('#lineChart'), {
                    type: 'line',
                    data: {
                      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                      datasets: [{
                        label: 'Line Chart',
                        data: [65, 59, 80, 81, 56, 55, 40],
                        fill: false,
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1
                      }]
                    },
                    options: {
                      scales: {
                        y: {
                          beginAtZero: true
                        }
                      }
                    }
                  });
                });
              </script>
              <!-- End Line CHart -->

            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Bar CHart</h5>

              <!-- Bar Chart -->
              <canvas id="barChart" style="max-height: 400px;"></canvas>
              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new Chart(document.querySelector('#barChart'), {
                    type: 'bar',
                    data: {
                      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                      datasets: [{
                        label: 'Bar Chart',
                        data: [65, 59, 80, 81, 56, 55, 40],
                        backgroundColor: [
                          'rgba(255, 99, 132, 0.2)',
                          'rgba(255, 159, 64, 0.2)',
                          'rgba(255, 205, 86, 0.2)',
                          'rgba(75, 192, 192, 0.2)',
                          'rgba(54, 162, 235, 0.2)',
                          'rgba(153, 102, 255, 0.2)',
                          'rgba(201, 203, 207, 0.2)'
                        ],
                        borderColor: [
                          'rgb(255, 99, 132)',
                          'rgb(255, 159, 64)',
                          'rgb(255, 205, 86)',
                          'rgb(75, 192, 192)',
                          'rgb(54, 162, 235)',
                          'rgb(153, 102, 255)',
                          'rgb(201, 203, 207)'
                        ],
                        borderWidth: 1
                      }]
                    },
                    options: {
                      scales: {
                        y: {
                          beginAtZero: true
                        }
                      }
                    }
                  });
                });
              </script>
              <!-- End Bar CHart -->

            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Pie Chart</h5>

              <!-- Pie Chart -->
              <canvas id="pieChart" style="max-height: 400px;"></canvas>
              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new Chart(document.querySelector('#pieChart'), {
                    type: 'pie',
                    data: {
                      labels: [
                        'Red',
                        'Blue',
                        'Yellow'
                      ],
                      datasets: [{
                        label: 'My First Dataset',
                        data: [300, 50, 100],
                        backgroundColor: [
                          'rgb(255, 99, 132)',
                          'rgb(54, 162, 235)',
                          'rgb(255, 205, 86)'
                        ],
                        hoverOffset: 4
                      }]
                    }
                  });
                });
              </script>
              <!-- End Pie CHart -->

            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Doughnut Chart</h5>

              <!-- Doughnut Chart -->
              <canvas id="doughnutChart" style="max-height: 400px;"></canvas>
              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new Chart(document.querySelector('#doughnutChart'), {
                    type: 'doughnut',
                    data: {
                      labels: [
                        'Red',
                        'Blue',
                        'Yellow'
                      ],
                      datasets: [{
                        label: 'My First Dataset',
                        data: [300, 50, 100],
                        backgroundColor: [
                          'rgb(255, 99, 132)',
                          'rgb(54, 162, 235)',
                          'rgb(255, 205, 86)'
                        ],
                        hoverOffset: 4
                      }]
                    }
                  });
                });
              </script>
              <!-- End Doughnut CHart -->

            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Radar Chart</h5>

              <!-- Radar Chart -->
              <canvas id="radarChart" style="max-height: 400px;"></canvas>
              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new Chart(document.querySelector('#radarChart'), {
                    type: 'radar',
                    data: {
                      labels: [
                        'Eating',
                        'Drinking',
                        'Sleeping',
                        'Designing',
                        'Coding',
                        'Cycling',
                        'Running'
                      ],
                      datasets: [{
                        label: 'First Dataset',
                        data: [65, 59, 90, 81, 56, 55, 40],
                        fill: true,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgb(255, 99, 132)',
                        pointBackgroundColor: 'rgb(255, 99, 132)',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgb(255, 99, 132)'
                      }, {
                        label: 'Second Dataset',
                        data: [28, 48, 40, 19, 96, 27, 100],
                        fill: true,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgb(54, 162, 235)',
                        pointBackgroundColor: 'rgb(54, 162, 235)',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgb(54, 162, 235)'
                      }]
                    },
                    options: {
                      elements: {
                        line: {
                          borderWidth: 3
                        }
                      }
                    }
                  });
                });
              </script>
              <!-- End Radar CHart -->

            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Polar Area Chart</h5>

              <!-- Polar Area Chart -->
              <canvas id="polarAreaChart" style="max-height: 400px;"></canvas>
              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new Chart(document.querySelector('#polarAreaChart'), {
                    type: 'polarArea',
                    data: {
                      labels: [
                        'Red',
                        'Green',
                        'Yellow',
                        'Grey',
                        'Blue'
                      ],
                      datasets: [{
                        label: 'My First Dataset',
                        data: [11, 16, 7, 3, 14],
                        backgroundColor: [
                          'rgb(255, 99, 132)',
                          'rgb(75, 192, 192)',
                          'rgb(255, 205, 86)',
                          'rgb(201, 203, 207)',
                          'rgb(54, 162, 235)'
                        ]
                      }]
                    }
                  });
                });
              </script>
              <!-- End Polar Area Chart -->

            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Stacked Bar Chart</h5>

              <!-- Stacked Bar Chart -->
              <canvas id="stakedBarChart" style="max-height: 400px;"></canvas>
              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new Chart(document.querySelector('#stakedBarChart'), {
                    type: 'bar',
                    data: {
                      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                      datasets: [{
                          label: 'Dataset 1',
                          data: [-75, -15, 18, 48, 74],
                          backgroundColor: 'rgb(255, 99, 132)',
                        },
                        {
                          label: 'Dataset 2',
                          data: [-11, -1, 12, 62, 95],
                          backgroundColor: 'rgb(75, 192, 192)',
                        },
                        {
                          label: 'Dataset 3',
                          data: [-44, -5, 22, 35, 62],
                          backgroundColor: 'rgb(255, 205, 86)',
                        },
                      ]
                    },
                    options: {
                      plugins: {
                        title: {
                          display: true,
                          text: 'Chart.js Bar Chart - Stacked'
                        },
                      },
                      responsive: true,
                      scales: {
                        x: {
                          stacked: true,
                        },
                        y: {
                          stacked: true
                        }
                      }
                    }
                  });
                });
              </script>
              <!-- End Stacked Bar Chart -->

            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Bubble Chart</h5>

              <!-- Bubble Chart -->
              <canvas id="bubbleChart" style="max-height: 400px;"></canvas>
              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new Chart(document.querySelector('#bubbleChart'), {
                    type: 'bubble',
                    data: {
                      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                      datasets: [{
                          label: 'Dataset 1',
                          data: [{
                              x: 20,
                              y: 30,
                              r: 15
                            },
                            {
                              x: 40,
                              y: 10,
                              r: 10
                            },
                            {
                              x: 15,
                              y: 37,
                              r: 12
                            },
                            {
                              x: 32,
                              y: 42,
                              r: 33
                            }
                          ],
                          borderColor: 'rgb(255, 99, 132)',
                          backgroundColor: 'rgba(255, 99, 132, 0.5)'
                        },
                        {
                          label: 'Dataset 2',
                          data: [{
                              x: 40,
                              y: 25,
                              r: 22
                            },
                            {
                              x: 24,
                              y: 47,
                              r: 11
                            },
                            {
                              x: 65,
                              y: 11,
                              r: 14
                            },
                            {
                              x: 11,
                              y: 55,
                              r: 8
                            }
                          ],
                          borderColor: 'rgb(75, 192, 192)',
                          backgroundColor: 'rgba(75, 192, 192, 0.5)'
                        }
                      ]
                    },
                    options: {
                      responsive: true,
                      plugins: {
                        legend: {
                          position: 'top',
                        },
                        title: {
                          display: true,
                          text: 'Chart.js Bubble Chart'
                        }
                      }
                    }
                  });
                });
              </script>
              <!-- End Bubble Chart -->

            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Area Chart</h5>

              <!-- Area Chart -->
              <div id="areaChart"></div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  const series = {
                    "monthDataSeries1": {
                      "prices": [
                        8107.85,
                        8128.0,
                        8122.9,
                        8165.5,
                        8340.7,
                        8423.7,
                        8423.5,
                        8514.3,
                        8481.85,
                        8487.7,
                        8506.9,
                        8626.2,
                        8668.95,
                        8602.3,
                        8607.55,
                        8512.9,
                        8496.25,
                        8600.65,
                        8881.1,
                        9340.85
                      ],
                      "dates": [
                        "13 Nov 2017",
                        "14 Nov 2017",
                        "15 Nov 2017",
                        "16 Nov 2017",
                        "17 Nov 2017",
                        "20 Nov 2017",
                        "21 Nov 2017",
                        "22 Nov 2017",
                        "23 Nov 2017",
                        "24 Nov 2017",
                        "27 Nov 2017",
                        "28 Nov 2017",
                        "29 Nov 2017",
                        "30 Nov 2017",
                        "01 Dec 2017",
                        "04 Dec 2017",
                        "05 Dec 2017",
                        "06 Dec 2017",
                        "07 Dec 2017",
                        "08 Dec 2017"
                      ]
                    },
                    "monthDataSeries2": {
                      "prices": [
                        8423.7,
                        8423.5,
                        8514.3,
                        8481.85,
                        8487.7,
                        8506.9,
                        8626.2,
                        8668.95,
                        8602.3,
                        8607.55,
                        8512.9,
                        8496.25,
                        8600.65,
                        8881.1,
                        9040.85,
                        8340.7,
                        8165.5,
                        8122.9,
                        8107.85,
                        8128.0
                      ],
                      "dates": [
                        "13 Nov 2017",
                        "14 Nov 2017",
                        "15 Nov 2017",
                        "16 Nov 2017",
                        "17 Nov 2017",
                        "20 Nov 2017",
                        "21 Nov 2017",
                        "22 Nov 2017",
                        "23 Nov 2017",
                        "24 Nov 2017",
                        "27 Nov 2017",
                        "28 Nov 2017",
                        "29 Nov 2017",
                        "30 Nov 2017",
                        "01 Dec 2017",
                        "04 Dec 2017",
                        "05 Dec 2017",
                        "06 Dec 2017",
                        "07 Dec 2017",
                        "08 Dec 2017"
                      ]
                    },
                    "monthDataSeries3": {
                      "prices": [
                        7114.25,
                        7126.6,
                        7116.95,
                        7203.7,
                        7233.75,
                        7451.0,
                        7381.15,
                        7348.95,
                        7347.75,
                        7311.25,
                        7266.4,
                        7253.25,
                        7215.45,
                        7266.35,
                        7315.25,
                        7237.2,
                        7191.4,
                        7238.95,
                        7222.6,
                        7217.9,
                        7359.3,
                        7371.55,
                        7371.15,
                        7469.2,
                        7429.25,
                        7434.65,
                        7451.1,
                        7475.25,
                        7566.25,
                        7556.8,
                        7525.55,
                        7555.45,
                        7560.9,
                        7490.7,
                        7527.6,
                        7551.9,
                        7514.85,
                        7577.95,
                        7592.3,
                        7621.95,
                        7707.95,
                        7859.1,
                        7815.7,
                        7739.0,
                        7778.7,
                        7839.45,
                        7756.45,
                        7669.2,
                        7580.45,
                        7452.85,
                        7617.25,
                        7701.6,
                        7606.8,
                        7620.05,
                        7513.85,
                        7498.45,
                        7575.45,
                        7601.95,
                        7589.1,
                        7525.85,
                        7569.5,
                        7702.5,
                        7812.7,
                        7803.75,
                        7816.3,
                        7851.15,
                        7912.2,
                        7972.8,
                        8145.0,
                        8161.1,
                        8121.05,
                        8071.25,
                        8088.2,
                        8154.45,
                        8148.3,
                        8122.05,
                        8132.65,
                        8074.55,
                        7952.8,
                        7885.55,
                        7733.9,
                        7897.15,
                        7973.15,
                        7888.5,
                        7842.8,
                        7838.4,
                        7909.85,
                        7892.75,
                        7897.75,
                        7820.05,
                        7904.4,
                        7872.2,
                        7847.5,
                        7849.55,
                        7789.6,
                        7736.35,
                        7819.4,
                        7875.35,
                        7871.8,
                        8076.5,
                        8114.8,
                        8193.55,
                        8217.1,
                        8235.05,
                        8215.3,
                        8216.4,
                        8301.55,
                        8235.25,
                        8229.75,
                        8201.95,
                        8164.95,
                        8107.85,
                        8128.0,
                        8122.9,
                        8165.5,
                        8340.7,
                        8423.7,
                        8423.5,
                        8514.3,
                        8481.85,
                        8487.7,
                        8506.9,
                        8626.2
                      ],
                      "dates": [
                        "02 Jun 2017",
                        "05 Jun 2017",
                        "06 Jun 2017",
                        "07 Jun 2017",
                        "08 Jun 2017",
                        "09 Jun 2017",
                        "12 Jun 2017",
                        "13 Jun 2017",
                        "14 Jun 2017",
                        "15 Jun 2017",
                        "16 Jun 2017",
                        "19 Jun 2017",
                        "20 Jun 2017",
                        "21 Jun 2017",
                        "22 Jun 2017",
                        "23 Jun 2017",
                        "27 Jun 2017",
                        "28 Jun 2017",
                        "29 Jun 2017",
                        "30 Jun 2017",
                        "03 Jul 2017",
                        "04 Jul 2017",
                        "05 Jul 2017",
                        "06 Jul 2017",
                        "07 Jul 2017",
                        "10 Jul 2017",
                        "11 Jul 2017",
                        "12 Jul 2017",
                        "13 Jul 2017",
                        "14 Jul 2017",
                        "17 Jul 2017",
                        "18 Jul 2017",
                        "19 Jul 2017",
                        "20 Jul 2017",
                        "21 Jul 2017",
                        "24 Jul 2017",
                        "25 Jul 2017",
                        "26 Jul 2017",
                        "27 Jul 2017",
                        "28 Jul 2017",
                        "31 Jul 2017",
                        "01 Aug 2017",
                        "02 Aug 2017",
                        "03 Aug 2017",
                        "04 Aug 2017",
                        "07 Aug 2017",
                        "08 Aug 2017",
                        "09 Aug 2017",
                        "10 Aug 2017",
                        "11 Aug 2017",
                        "14 Aug 2017",
                        "16 Aug 2017",
                        "17 Aug 2017",
                        "18 Aug 2017",
                        "21 Aug 2017",
                        "22 Aug 2017",
                        "23 Aug 2017",
                        "24 Aug 2017",
                        "28 Aug 2017",
                        "29 Aug 2017",
                        "30 Aug 2017",
                        "31 Aug 2017",
                        "01 Sep 2017",
                        "04 Sep 2017",
                        "05 Sep 2017",
                        "06 Sep 2017",
                        "07 Sep 2017",
                        "08 Sep 2017",
                        "11 Sep 2017",
                        "12 Sep 2017",
                        "13 Sep 2017",
                        "14 Sep 2017",
                        "15 Sep 2017",
                        "18 Sep 2017",
                        "19 Sep 2017",
                        "20 Sep 2017",
                        "21 Sep 2017",
                        "22 Sep 2017",
                        "25 Sep 2017",
                        "26 Sep 2017",
                        "27 Sep 2017",
                        "28 Sep 2017",
                        "29 Sep 2017",
                        "03 Oct 2017",
                        "04 Oct 2017",
                        "05 Oct 2017",
                        "06 Oct 2017",
                        "09 Oct 2017",
                        "10 Oct 2017",
                        "11 Oct 2017",
                        "12 Oct 2017",
                        "13 Oct 2017",
                        "16 Oct 2017",
                        "17 Oct 2017",
                        "18 Oct 2017",
                        "19 Oct 2017",
                        "23 Oct 2017",
                        "24 Oct 2017",
                        "25 Oct 2017",
                        "26 Oct 2017",
                        "27 Oct 2017",
                        "30 Oct 2017",
                        "31 Oct 2017",
                        "01 Nov 2017",
                        "02 Nov 2017",
                        "03 Nov 2017",
                        "06 Nov 2017",
                        "07 Nov 2017",
                        "08 Nov 2017",
                        "09 Nov 2017",
                        "10 Nov 2017",
                        "13 Nov 2017",
                        "14 Nov 2017",
                        "15 Nov 2017",
                        "16 Nov 2017",
                        "17 Nov 2017",
                        "20 Nov 2017",
                        "21 Nov 2017",
                        "22 Nov 2017",
                        "23 Nov 2017",
                        "24 Nov 2017",
                        "27 Nov 2017",
                        "28 Nov 2017"
                      ]
                    }
                  }
                  new ApexCharts(document.querySelector("#areaChart"), {
                    series: [{
                      name: "STOCK ABC",
                      data: series.monthDataSeries1.prices
                    }],
                    chart: {
                      type: 'area',
                      height: 350,
                      zoom: {
                        enabled: false
                      }
                    },
                    dataLabels: {
                      enabled: false
                    },
                    stroke: {
                      curve: 'straight'
                    },
                    subtitle: {
                      text: 'Price Movements',
                      align: 'left'
                    },
                    labels: series.monthDataSeries1.dates,
                    xaxis: {
                      type: 'datetime',
                    },
                    yaxis: {
                      opposite: true
                    },
                    legend: {
                      horizontalAlign: 'left'
                    }
                  }).render();
                });
              </script>
              <!-- End Area Chart -->

            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Column Chart</h5>

              <!-- Column Chart -->
              <div id="columnChart"></div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new ApexCharts(document.querySelector("#columnChart"), {
                    series: [{
                      name: 'Net Profit',
                      data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
                    }, {
                      name: 'Revenue',
                      data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
                    }, {
                      name: 'Free Cash Flow',
                      data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
                    }],
                    chart: {
                      type: 'bar',
                      height: 350
                    },
                    plotOptions: {
                      bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded'
                      },
                    },
                    dataLabels: {
                      enabled: false
                    },
                    stroke: {
                      show: true,
                      width: 2,
                      colors: ['transparent']
                    },
                    xaxis: {
                      categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
                    },
                    yaxis: {
                      title: {
                        text: '$ (thousands)'
                      }
                    },
                    fill: {
                      opacity: 1
                    },
                    tooltip: {
                      y: {
                        formatter: function(val) {
                          return "$ " + val + " thousands"
                        }
                      }
                    }
                  }).render();
                });
              </script>
              <!-- End Column Chart -->

            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Donut Chart</h5>

              <!-- Donut Chart -->
              <div id="donutChart"></div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new ApexCharts(document.querySelector("#donutChart"), {
                    series: [44, 55, 13, 43, 22],
                    chart: {
                      height: 350,
                      type: 'donut',
                      toolbar: {
                        show: true
                      }
                    },
                    labels: ['Team A', 'Team B', 'Team C', 'Team D', 'Team E'],
                  }).render();
                });
              </script>
              <!-- End Donut Chart -->

            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Radial Bar Chart</h5>

              <!-- Radial Bar Chart -->
              <div id="radialBarChart"></div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new ApexCharts(document.querySelector("#radialBarChart"), {
                    series: [44, 55, 67, 83],
                    chart: {
                      height: 350,
                      type: 'radialBar',
                      toolbar: {
                        show: true
                      }
                    },
                    plotOptions: {
                      radialBar: {
                        dataLabels: {
                          name: {
                            fontSize: '22px',
                          },
                          value: {
                            fontSize: '16px',
                          },
                          total: {
                            show: true,
                            label: 'Total',
                            formatter: function(w) {
                              // By default this function returns the average of all series. The below is just an example to show the use of custom formatter function
                              return 249
                            }
                          }
                        }
                      }
                    },
                    labels: ['Apples', 'Oranges', 'Bananas', 'Berries'],
                  }).render();
                });
              </script>
              <!-- End Radial Bar Chart -->

            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Vertical Bar Chart</h5>

              <!-- Vertical Bar Chart -->
              <div id="verticalBarChart" style="min-height: 400px;" class="echart"></div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  echarts.init(document.querySelector("#verticalBarChart")).setOption({
                    title: {
                      text: 'World Population'
                    },
                    tooltip: {
                      trigger: 'axis',
                      axisPointer: {
                        type: 'shadow'
                      }
                    },
                    legend: {},
                    grid: {
                      left: '3%',
                      right: '4%',
                      bottom: '3%',
                      containLabel: true
                    },
                    xAxis: {
                      type: 'value',
                      boundaryGap: [0, 0.01]
                    },
                    yAxis: {
                      type: 'category',
                      data: ['Brazil', 'Indonesia', 'USA', 'India', 'China', 'World']
                    },
                    series: [{
                        name: '2011',
                        type: 'bar',
                        data: [18203, 23489, 29034, 104970, 131744, 630230]
                      },
                      {
                        name: '2012',
                        type: 'bar',
                        data: [19325, 23438, 31000, 121594, 134141, 681807]
                      }
                    ]
                  });
                });
              </script>
              <!-- End Vertical Bar Chart -->

            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Candle Stick Chart</h5>

              <!-- Candle Stick Chart -->
              <div id="candleStickChart" style="min-height: 400px;" class="echart"></div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  echarts.init(document.querySelector("#candleStickChart")).setOption({
                    xAxis: {
                      data: ['2017-10-24', '2017-10-25', '2017-10-26', '2017-10-27']
                    },
                    yAxis: {},
                    series: [{
                      type: 'candlestick',
                      data: [
                        [20, 34, 10, 38],
                        [40, 35, 30, 50],
                        [31, 38, 33, 44],
                        [38, 15, 5, 42]
                      ]
                    }]
                  });
                });
              </script>
              <!-- End Candle Stick Chart -->

            </div>
          </div>
        </div>