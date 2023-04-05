
var c = document.getElementById("myCanvas");
var ctx = c.getContext("2d");

// SAD sector
ctx.beginPath();
// kleur
ctx.fillStyle = "#00ffaa";
// de startpositie
ctx.moveTo(100,75);
// 100, 75 = x-y coordinaten, 50 = straal, 0 = de straal waar de boog eindigt
ctx.arc(100, 75, 50, 0,);
// gesloten vorm
ctx.lineTo(100,75);
// vult de vorm van de ingestelde vormkleur
ctx.fill();

// HAPPY sector
ctx.beginPath();
ctx.fillStyle = "#00aaaa";
ctx.moveTo(100,75);
ctx.arc(100, 75, 50,);
ctx.lineTo(100,75);
ctx.fill();

// EXCITED sector
ctx.beginPath();
ctx.fillStyle = "#00ffff";
ctx.moveTo(100,75);
ctx.arc(100, 75, 50, );
ctx.lineTo(100,75);
ctx.fill();

// ANGRY sector
ctx.beginPath();
ctx.fillStyle = "#ff0000";
ctx.moveTo(100,75);
ctx.arc(100, 75, 50,);
ctx.lineTo(100,75);
ctx.fill();
