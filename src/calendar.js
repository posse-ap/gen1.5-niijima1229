var calendar=document.getElementById("calendar");

const config = {
  dateFormat: "Y年m月d日",
}

flatpickr(calendar,config);


// $(function() {
//   $('#demo001').pickadate();
// });

const calendar_today =new Date();
var calendar_year =calendar_today.getFullYear();
var calendar_month =calendar_today.getMonth();
//1月は0
var calendar_date =calendar_today.getDate();

function study_date_text(year =calendar_year,month =calendar_month,date =calendar_date){
  return `${year}年${month+1}月${date}日`;
};

document.getElementById("calendar").value =study_date_text();

function prev_month(){
  const date =[];
  const prev_last_date =new Date(calendar_year,calendar_month,0).getDate();
  const this_first_day =new Date(calendar_year,calendar_month,1).getDay();
  for (let i=0; i<this_first_day;i++){
    date.unshift(prev_last_date-i);
  }
  return date;
}

function this_month(){
  const date =[];
  const this_last_date =new Date(calendar_year,calendar_month+1,0).getDate();
  for (let i=1;i<=this_last_date;i++){
    date.push(i);
  }
  return date;
}

function next_month(){
  const date =[];
  const this_last_day =new Date(calendar_year,calendar_month+1,0).getDay();
  for (let i=0;i<6-this_last_day;i++){
    date.push(i+1);
  }
  return date;
}

function create_calendar(){
  const date=[
    ...prev_month(),
    ...this_month(),
    ...next_month(),
  ];

  let week=[];

  for(let i=date.length;i>0;i-7){
    week.push(date.splice(0,7));
  }
  
  const calendar_date=document.getElementById("calendar_date");

  week.forEach(function(week_count,date){
    
    document.createElement("tr");
    for (let i=0;i<date;i++){
      var td=document.createElement("td");
      td.innerHTML=i
    }
  })
  
}

