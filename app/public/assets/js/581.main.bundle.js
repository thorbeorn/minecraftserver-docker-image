"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[581],{581:(a,e,t)=>{t.r(e),t.d(e,{default:()=>n});var r=t(231),d=t(221);r.ZP.register(d.ZP);var l=document.getElementById("cpu-performance-chart"),o=new r.ZP(l,{type:"line",data:{labels:[],datasets:[{label:"Utilisation du CPU",data:[],backgroundColor:"rgba(76, 175, 80, 0.2)",borderColor:"rgba(76, 175, 80, 1)",borderWidth:3}]},options:{plugins:{zoom:{pan:{enabled:!0,mode:"xy"},zoom:{wheel:{enabled:!0},drag:{enabled:!0},pinch:{enabled:!0},mode:"xy"}}},responsive:!0,scales:{y:{beginAtZero:!0,max:100}},elements:{line:{fill:"start",backgroundColor:"rgba(76, 175, 80, 0.2)",borderColor:"rgba(76, 175, 80, 1)",borderWidth:1}}}});function n(){setInterval((function(){var a,e;a=(new Date).toLocaleTimeString(),e=100*Math.random(),o.data.labels.push(a),o.data.datasets[0].data.push(e),o.data.labels.length>60&&(o.data.labels.shift(),o.data.datasets[0].data.shift()),o.update()}),1e3)}}}]);
//# sourceMappingURL=581.main.bundle.js.map