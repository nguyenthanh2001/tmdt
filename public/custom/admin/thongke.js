let myChart = document.getElementById('myChart');
let CakeTop = document.getElementById('CakeTop');


// Global Options
Chart.defaults.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.defaultFontColor = '#858796';

var kq = function () {
    var tmp = null;
    $.ajax({
        async: false,
        method: "GET",
        url:urlLoai,
        success: function (data) {
            tmp = data.arr;
        }
    });
    return tmp;
}();
let nameCategory = [];
let numCategory = [];
for (const key in kq) {
    nameCategory.push(kq[key].tenloai)
    numCategory.push(kq[key].soluongbanh)
  }
console.log(nameCategory);
const data = {
  labels: nameCategory,
  datasets: [{
    label: 'Số lượng loại sản phẩm',
    data: numCategory,
    backgroundColor:[
        "#3e95cd", 
        "#8e5ea2",
        "#3cba9f",
        "#e8c3b9",
        "#c45850",
        "#fc8621",
        "#c24914",
        "#F32424"
    ],
    borderWidth: 1
  }]
};
const config = {
    type: 'bar',
    data: data,
    options: {
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            callback: function(value, index, ticks) {
                return "Số lượng "+value;
            }
        }
        }
      }
    },
  };

  const dataTop = {
    labels:NameTop,
    datasets: [{
      label: 'Top 5 sản phẩm',
      data: QuantityTop,
      backgroundColor: [
        '#FF8AAE',
        '#FFB2A6',
        '#FFF89A',
        '#9ADCFF',
        '#00C897'
      ],
      hoverOffset: 4
    }]
  };
  const configTop = {
    type: 'doughnut',
    data: dataTop,
  };

  new Chart(myChart, config);
  new Chart(CakeTop, configTop);
