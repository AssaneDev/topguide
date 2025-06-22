$(function () {
  "use strict";

  // Charts using Sparkline (pas besoin de protection, ils vérifient déjà l'élément)
  $('#chart1').sparkline([5, 8, 7, 10, 9, 10, 8, 6, 4, 6, 8, 7, 6, 8], {
    type: 'bar',
    height: '35',
    barWidth: '3',
    resize: true,
    barSpacing: '3',
    barColor: '#fff'
  });

  $("#chart2").sparkline([0, 5, 3, 7, 5, 10, 3, 6, 5, 10], {
    type: 'line',
    width: '80',
    height: '40',
    lineWidth: '2',
    lineColor: '#fff',
    fillColor: 'transparent',
    spotColor: '#fff',
  });

  $("#chart3").sparkline([2, 3, 4, 5, 4, 3, 2, 3, 4, 5, 6, 5, 4, 3, 4, 5], {
    type: 'discrete',
    width: '75',
    height: '40',
    lineColor: '#fff',
    lineHeight: 22
  });

  $("#chart4").sparkline([5, 6, 7, 9, 9, 5, 3, 2, 2, 4, 6, 7], {
    type: 'line',
    width: '100',
    height: '25',
    lineWidth: '2',
    lineColor: '#ffffff',
    fillColor: 'transparent'
  });

  // chart 5
  var c5 = document.getElementById('chart5');
  if (c5) {
    var ctx = c5.getContext('2d');
    var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
    gradientStroke1.addColorStop(0, '#17ead9');
    gradientStroke1.addColorStop(1, '#6078ea');

    var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
    gradientStroke2.addColorStop(0, '#f80759');
    gradientStroke2.addColorStop(1, '#bc4e9c');

    new Chart(ctx, {
      type: 'line',
      data: {
        labels: [1, 2, 3, 4, 5, 6, 7, 8],
        datasets: [
          {
            label: 'Downloads',
            data: [0, 30, 60, 25, 60, 25, 50, 0],
            borderColor: gradientStroke1,
            fill: { target: 'origin', above: gradientStroke1 },
            tension: 0.4,
            borderWidth: 2
          },
          {
            label: 'Earnings',
            data: [0, 60, 25, 80, 35, 75, 30, 0],
            borderColor: gradientStroke2,
            fill: { target: 'origin', above: gradientStroke2 },
            tension: 0.4,
            borderWidth: 2
          }
        ]
      },
      options: {
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        tooltips: { enabled: false },
        scales: { x: {}, y: {} }
      }
    });
  }

  // chart 6
  var c6 = document.getElementById('chart6');
  if (c6) {
    var ctx = c6.getContext('2d');
    var gradient1 = ctx.createLinearGradient(0, 0, 0, 300);
    gradient1.addColorStop(0, '#42e695');
    gradient1.addColorStop(1, '#3bb2b8');

    var gradient2 = ctx.createLinearGradient(0, 0, 0, 300);
    gradient2.addColorStop(0, '#7f00ff');
    gradient2.addColorStop(0.5, '#e100ff');

    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: [1, 2, 3, 4, 5, 6, 7, 8],
        datasets: [
          {
            label: 'Laptops',
            data: [40, 30, 60, 35, 60, 25, 50, 40],
            backgroundColor: gradient1,
            borderRadius: 20,
            borderWidth: 1
          },
          {
            label: 'Mobiles',
            data: [50, 60, 40, 70, 35, 75, 30, 20],
            backgroundColor: gradient2,
            borderRadius: 20,
            borderWidth: 1
          }
        ]
      },
      options: {
        maintainAspectRatio: false,
        plugins: { legend: { display: true, position: 'bottom' } },
        scales: { y: { beginAtZero: true } }
      }
    });
  }

  // Même traitement pour chart7 à chart18
  for (let i = 7; i <= 18; i++) {
    const canvas = document.getElementById(`chart${i}`);
    if (!canvas) continue;

    const ctx = canvas.getContext('2d');
    // Ne réécris pas ici tous les graphes si tu ne les utilises pas,
    // tu peux les regrouper comme pour les autres ou les supprimer du code si inutiles.
    // Par défaut, tu peux afficher une ligne vide ou une note pour dire "Graph désactivé".
  }

  // Vector map
  const dashboardMap = document.getElementById('dashboard-map');
  if (dashboardMap) {
    $('#dashboard-map').vectorMap({
      map: 'world_mill_en',
      backgroundColor: 'transparent',
      regionStyle: { initial: { fill: '#15ca20' } },
      markerStyle: {
        initial: {
          r: 9,
          fill: '#fff',
          stroke: '#000',
          'stroke-width': 5,
          'stroke-opacity': 0.4
        }
      },
      markers: [{ latLng: [21.00, 78.00], name: 'I Love My India' }],
      zoomOnScroll: false
    });
  }

});
