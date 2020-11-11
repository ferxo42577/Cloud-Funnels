function createChart(id,title="",type="line")
{
//create chart
this.id=id;
this.labels=[];
//add datas object with append function
this.datas=[];
this.options={responsive:true,
maintainAspectRatio: false,
scales: {
  yAxes: [
      {
        ticks: {
          beginAtZero: true,
          callback: function(value) {if (value % 1 === 0) {return value;}}
          },
      }
  ]
},
};

this.popCanvas = document.getElementById(this.id).getContext("2d");

this.append=function(data){this.datas.push(data)};

this.addOption=function(name,data){this.options[name]=data;};

if(title.length>0){this.addOption('title',{display:true,text:title});}

this.draw=function(){
  var steps=3;
  new Chart(this.popCanvas, {
  type: type,
  data: {
    labels:this.labels,
    datasets:this.datas,
  },
options:this.options,
});};
}
