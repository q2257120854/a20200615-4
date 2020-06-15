// Line chart with two dataset
var data = {
  labels: ["01/2016", "02/2016", "03/2016", "04/2016", "05/2016", "06/2016", "07/2016"],
  datasets: [
    {
      label: "Admin",
      fill: true,
      lineTension: 0.4,
      backgroundColor: "rgba(2,93,131,.3)",
      borderColor: "rgba(2,93,131,1)",
      borderWidth: 2,
      borderCapStyle: 'butt',
      borderJoinStyle: 'bevel',
      pointBorderColor: "rgba(2,93,131,1)",
      pointBackgroundColor: "#fff",
      pointBorderWidth: 2,
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(2,93,131,1)",
      pointHoverBorderColor: "rgba(2,93,131,1)",
      pointHoverBorderWidth: 2,
      pointRadius: 4,
      pointHitRadius: 10,
      data: [30, 75, 46, 71, 70, 20, 65],
      spanGaps: false,
    },
    {
      label: "Ecommerce",
      fill: true,
      lineTension: 0.4,
      backgroundColor: "rgba(112,193,179,.5)",
      borderColor: "rgba(112,193,179,1)",
      borderWidth: 2,
      borderCapStyle: 'butt',
      borderJoinStyle: 'bevel',
      pointBorderColor: "rgba(112,193,179,1)",
      pointBackgroundColor: "#fff",
      pointBorderWidth: 1,
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(112,193,179,1)",
      pointHoverBorderColor: "rgba(112,193,179,1)",
      pointHoverBorderWidth: 2,
      pointRadius: 4,
      pointHitRadius: 10,
      data: [65, 20, 70, 80, 46, 75, 30],
      spanGaps: false,
    }
  ],

}


var options = {
 scales: {
    yAxes: [{
      ticks: {
        beginAtZero:true,
        max: 100,
        stepSize: 25,
        fontColor: "#ccc",
        fontFamily:  '"Montserrat", sans-serif',

      },
      gridLines: {
        drawTicks: true
      }
    }],
    xAxes:[{
      ticks: {
        fontColor: "#ccc",
        fontFamily:  '"Montserrat", sans-serif',
      }
    }]
  },
  legend: {
    display: false,
  }
}

var ctx = document.querySelector(".lineChart");

if (ctx) {
  var myChart = new Chart(ctx, {
    type: 'line',
    data: data,
    options: options
  });

  document.querySelector('.js-legend').innerHTML = myChart.generateLegend();
}



// Line chart graph
var dataGraph = {
  labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
  datasets: [
    {
      label: "Views",
      fill: true,
      lineTension: 0.4,
      backgroundColor: "rgba(98, 187, 171, .4)",
      borderColor: "rgba(98, 187, 171, 1)",
      borderWidth: 3,
      borderCapStyle: 'butt',
      borderJoinStyle: 'bevel',
      pointBorderColor: "rgba(98, 187, 171, 1)",
      pointBackgroundColor: "rgba(98, 187, 171, 1)",
      pointBorderWidth: 2,
      pointHoverRadius: 6,
      pointHoverBackgroundColor: "#fff",
      pointHoverBorderColor: "rgba(98, 187, 171, 1)",
      pointHoverBorderWidth: 2,
      pointRadius: 1,
      pointHitRadius: 10,
      data: [28, 55, 19, 86, 27, 90],
      spanGaps: false,
    },
  ],
}


var optionsGraph = {
  scales: {

    yAxes: [{
      ticks: {
        beginAtZero:true,
        max: 100,
        stepSize: 25,
        fontColor: "#ccc",
        fontFamily:  '"Montserrat", sans-serif',

      },
      gridLines: {
        drawTicks: true
      }
    }],
    xAxes:[{
      ticks: {
        fontColor: "#ccc",
        fontFamily:  '"Montserrat", sans-serif',
      }
    }]
  },
  legend: {
    display: false,
  }
}

var ctxGraph = document.querySelector(".lineChartGraph");

if (ctxGraph) {
  var myChartGraph = new Chart(ctxGraph, {
    type: 'line',
    data: dataGraph,
    options: optionsGraph
  });
}




// Doughnut chart

var dataDoughnut = {
  labels: [
    "Comapany X",
    "Company Y",
    "Company Z",
    "Company G"
  ],
  datasets: [{
    data: [35, 10, 15, 40],
    backgroundColor: [
      "#f3ffbd",
      "#70c1b3",
      "#b2dbbf",
      "#025d83"
    ],
    borderWidth: 0,
  }]
};


var optionsDoughnut = {
  legend: {
    display: false,
  },
}

var ctxDoughnut = document.querySelector(".doughNut-chart");

if (ctxDoughnut) {
  var myDoughnutChart = new Chart(ctxDoughnut, {
    type: 'doughnut',
    data: dataDoughnut,
    options: optionsDoughnut
  });

  document.querySelector('.js-legendDoughnut').innerHTML = myDoughnutChart.generateLegend();
}





// piechart

var optionsDoughnutPie = {
  legend: {
    display: false,
  },
  tooltips: {
    enabled: false
  },
}

var ctxPie = document.querySelector(".pichart");

if (ctxPie) {
  var myPieChart = new Chart(ctxPie, {
    type: 'pie',
    data: dataDoughnut,
    options: optionsDoughnutPie
  });
}



// Small user doughnut chart to analyse user performance
var dataDoughnutsmall = {
  labels: [
    "Red",
    "Blue",
    "Yellow",
    "Green"
  ],
  datasets: [{
    data: [35, 25, 20, 20],
    backgroundColor: [
      "#eb547c",
      "#70c1b3",
      "#b2dbbf",
      "#025d83"
    ],
    borderWidth: 0,
  }]
};

var ctxDoughnutsmall = document.querySelector(".smalldoughnutchart");

if (ctxDoughnutsmall) {
  var myDoughnutChartsmall = new Chart(ctxDoughnutsmall, {
    type: 'doughnut',
    data: dataDoughnutsmall,
    options: optionsDoughnutPie,

  });
}


// Small user doughnut chart to analyse user performance thin
var dataDoughnutThin = {
  labels: [
    "Red",
    "Blue",
  ],
  datasets: [{
    data: [65, 35],
    backgroundColor: [
      "#eb547c",
      "#025d83"
    ],
    borderWidth: 0,
  }]
};

var thindoughnutoptions = {
  legend: {
    display: false,
  },
  tooltips: {
    enabled: false
  },
  cutoutPercentage: 80
}

var ctxDoughnutThin = document.querySelector(".smalldoughnutchartthin");

if (ctxDoughnutThin) {
  var myDoughnutChartThin = new Chart(ctxDoughnutThin, {
    type: 'doughnut',
    data: dataDoughnutThin,
    options: thindoughnutoptions,

  });
}


