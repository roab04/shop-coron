/**
 * Đức: Hàm tạo chart doanh thu
 *  */ 
function setUpChartBar(datas) {
    console.log(datas);
    const xValues = [];
    const yValues = [];
    datas.map((data) => xValues.push(data.month));
    datas.map((data) => yValues.push(data.revenue));
    let barColors = ["red","red","red","red","red","red","red","red","red","red","red","red",];
    new Chart("myChart", {
        type: "bar",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                data: yValues
            }]
        },
        options: {
            legend: {
                display: false
            },
            title: {
                display: false,
                text: "Doanh thu"
            }
        }
    });
}

/**
 * Đức: Xử lý dữ liệu cho chart doanh thu
 *  */ 
function formatDataBar(revenues_php, year) {
    const revenues = JSON.parse(revenues_php.split(','));
    const datas = [];
    const values = [];
    let value = 0;
    let last_value = 0;
    revenues.map((revenue) => {
        if(Number(revenue.nam) == year) {
            value = Number(revenue.thang);
            if(values.length != 0) {
                last_value = Number(values[values.length - 1]);
            }
            for (var i = last_value + 1; i <= value; i++) {
                if(i != value) {
                    datas.push({
                        month: i,
                        revenue: 0
                    });
                }
            }
            datas.push({
                month: Number(revenue.thang),
                revenue: Number(revenue.doanh_thu)
            });
            values.push(value);
            last_value = Number(values[values.length - 1]);
        }
    })
    for(var i = last_value + 1; i <= 12; i++) {
        datas.push({
            month: i,
            revenue: 0
        });
    }
    setUpChartBar(datas);
}

// (function setUpChartPie() {
//     const polarColors = ['red', 'yellow', 'green', 'blue'];
//     const data = {
//         datasets: [{
//             backgroundColor: polarColors,
//             data: [10, 20, 30, 55]
//         }],
//         // These labels appear in the legend and in the tooltips when hovering different arcs
//         labels: [
//             'Red',
//             'Yellow',
//             'Blue'
//         ]
//     };
    
//     const options = {
//         legend: {
//             display: false
//         },
//         title: {
//             display: true,
//             text: "Order status"
//         }
//     }
//     new Chart("myPolarChart", {
//         data: data,
//         type: 'pie',
//         options: options
//     });
// })()
