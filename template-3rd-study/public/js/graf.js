google.charts.load("current", {packages:["corechart"]});
google.charts.setOnLoadCallback(draw_lang_chart);
google.charts.setOnLoadCallback(draw_cont_chart);
function draw_lang_chart() {
// let xhr = new XMLHttpRequest();
// xhr.open('GET', "http://posse-task.anti-pattern.co.jp/1st-work/study_contents.json");
// xhr.withCredentials = true;
// xhr.onload = () => {
// let responseJson = JSON.parse(xhr.response);
// console.log(responseJson.name);
// }
// xhr.send();


var data = google.visualization.arrayToDataTable([
['language', 'Hours per Day'],
['javascript', 10],
['css', 20],
['php', 5],
['html', 30],
['laravel', 5],
['sql', 20],
['shell',20],
['others',10]
]);

var options = {
pieHole: 0.5,
legend: 'none',
colors:['#2A54EF','#1B71BD','#21BDDE','#3DCEFD','#B39EF3','#6D47EC','#4A18EF','#3107BF'],
width:'100%',
height:'254',
chartArea:{width:'100%',height:'100%',top:0},

};

var chart = new google.visualization.PieChart(document.getElementById('donutchart_lang'));
chart.draw(data, options);

function resizeHandler () {
chart.draw(data, options);
}
if (window.addEventListener) {
window.addEventListener('resize', resizeHandler, false);
}
else if (window.attachEvent) {
window.attachEvent('onresize', resizeHandler);
}

var resize_graf =_.throttle(resizeHandler,5000)
window.addEventListener("resize",resize_graf)

}

function draw_cont_chart() {
var data = google.visualization.arrayToDataTable([
['content', 'percent'],
['N予備校', 40],
['ドットインストール', 20],
['課題', 40]

]);

var options = {
pieHole: 0.5,
legend: 'none',
colors:['#2A54EF','#1B71BD','#21BDDE'],
width:'100%',
height:'254',
chartArea:{width:'100%',height:'100%',top:0}
};

var chart = new google.visualization.PieChart(document.getElementById('donutchart_cont'));
chart.draw(data, options);

function resizeHandler () {
chart.draw(data, options);
}
if (window.addEventListener) {
window.addEventListener('resize', resizeHandler, false);
}
else if (window.attachEvent) {
window.attachEvent('onresize', resizeHandler);
}

var resize_graf =_.throttle(resizeHandler,5000)
window.addEventListener("resize",resize_graf)
}

google.charts.load('current', {'packages':['bar']});
google.charts.setOnLoadCallback(draw_var_chart);
function draw_var_chart() {
var data = google.visualization.arrayToDataTable([
["day", "time"],
[1,3],
[2,4],
[3,5],
[4,3],
[5,0],
[6,0],
[7,4],
[8,2],
[9,2],
[10,8],
[11,8],
[12,2],
[13,2],
[14,1],
[15,7],
[16,4],
[17,4],
[18,3],
[19,3],
[20,3],
[21,2],
[22,2],
[23,6],
[24,2],
[25,2],
[26,1],
[27,1],
[28,1],
[29,7],
[30,8]
]);

var view = new google.visualization.DataView(data);
view.setColumns([0, 1,
{

calc: "stringify",
sourceColumn: 1,
type: "string",
role: "annotation",

}
]);

var options = {
legend: { position: 'none' },
width:"100%",
height: 400,
bar: {groupWidth: "90%"},
vAxis:{
minValue:0,
gridlines:{color: 'none', count:3},
baselineColor: 'none',
textPosition: 'out',
ticks:[2,4,6,8]
},
};
var chart = new google.charts.Bar(document.getElementById("columnchart_values"));
chart.draw(data, google.charts.Bar.convertOptions(options));

function resizeHandler () {
chart.draw(data, options);
}
if (window.addEventListener) {
// これだとresizeのたびに毎回イベント発火する
// -> チャートを何回も作り直してしまう
// -> ブラウザに負担がかかる
// -> 100回イベントが起きたとて、1回だけ処理すればいい
// -> throttleを使う
// TODO
// throttoleを使えるライブラリを探す(CDN)
// resizeHandlerの発火回数を抑える
window.addEventListener('resize', resizeHandler, false);
}
else if (window.attachEvent) {
window.attachEvent('onresize', resizeHandler);
}

var resize_graf =_.throttle(resizeHandler,5000)
window.addEventListener("resize",resize_graf)
}
