        <script src="<?php echo base_url('assets/js/jquery-1.11.0.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/Chart.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/bootstrap-tour.min.js') ?>"></script>
        <script type="text/javascript">
          document.addEventListener("contextmenu", function(e){
            e.preventDefault();
          }, false);

          // jQuery plugin to prevent double submission of forms
          jQuery.fn.preventDoubleSubmission = function() {
            $(this).on('submit',function(e){
              var $form = $(this);

              if ($form.data('submitted') === true) {
      // Previously submitted - don't submit again
      e.preventDefault();
    } else {
      // Mark it so that the next submit can be ignored
      $form.data('submitted', true);
    }
  });

  // Keep chainability
  return this;
};
$('#formSelect').submit(function(){
  $('#formSelect').preventDoubleSubmission();
  $(this).find(':submit').attr('disabled','disabled');
});
</script>
<?php if(isset($redirect_5_seconds)):?>
  <script>
    function startTimer(duration, display) {
      var timer = duration, minutes, seconds;
      var end =setInterval(function () {
            //minutes = parseInt(timer / 60, 10)
            seconds = parseInt(timer, 10);

            //minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "" + seconds : seconds;

            display.textContent = seconds;

            if (--timer < 0) {
              window.location = rootURL + "logout";
              clearInterval(end);
            }
          }, 1000);
    }

    window.onload = function () {
      var fiveSeconds = 4,
      display = document.querySelector('#time');
      startTimer(fiveSeconds, display);
    };
  </script>
<?php endif?>
<?php if(isset($live_count)): ?>
  <script type="text/javascript">
    $(document).ready(function() {

      var jsonData = $.ajax({
        url: rootURL + '/vote/ajax_count',
        dataType: 'json',
      }).done(function (results) {
        var labels = [], data=[];
        results["result"].forEach(function(packet) {
          data.push(parseFloat(packet.data));
          labels.push(packet.labels);
        });


        var tempData = {
          labels: labels,
          datasets: [
          {
            data: data,
            backgroundColor: [
            "#FF6384",
            "#36A2EB",
            "#30cd72",
            "#95a5a6"
            ],
            hoverBackgroundColor: [
            "#FF6384",
            "#36A2EB",
            "#30cd72",
            "#95a5a6"
            ]
          }]
        };

        var ctx = $("#myChart");

        var myPieChart = new Chart(ctx,{
          type: 'pie',
          data: tempData,
          options: {
            title: {
              display: true,
              text: 'Perolehan Suara Sementara'
            },
            responsive: true,
            maintainAspectRatio: false,
            tooltips: {
              callbacks: {
                label: function(tooltipItem, data) {
                  var allData = data.datasets[tooltipItem.datasetIndex].data;
                  var tooltipLabel = data.labels[tooltipItem.index];
                  var tooltipData = allData[tooltipItem.index];
                  var total = 0;
                  for (var i in allData) {
                    total += allData[i];
                  }
                  var tooltipPercentage = Math.round((tooltipData / total) * 100);
                  return tooltipLabel + ': ' + tooltipData + ' (' + tooltipPercentage + '%)';
                }
              }
            }
          }
        });

        setInterval(function(){
          $('#tableHolder').load(rootURL + 'vote/table_count');
          var jsonData = $.ajax({
            url: rootURL +'vote/ajax_count',
            dataType: 'json',
          }).done(function (results) {
            var labels = [], data=[];
            results["result"].forEach(function(packet) {
              data.push(parseFloat(packet.data));
              labels.push(packet.labels);
            });
            myPieChart.data.datasets[0].data = data;
            myPieChart.update();
          });
        }, 30000);

        setInterval(function(){
          $('#commentSection').load(rootURL + 'vote/comment_live');
        }, 5000);

      });
    });
  </script>
<?php endif ?>
<?php if(isset($kandidat_page)):?>
  <script type="text/javascript">
    var tour = new Tour({
      storage: false,
      backdrop: false,
      steps: [
      {
        placement: "bottom",
        element: "#kandidat",
        title: "Pilih Kandidat",
        content: "Silahkan klik pada kandidat yang ingin anda pilih"
      }],
      template: "<div class='popover tour'>"+
      "<div class='arrow'></div>"+
      "<h3 class='popover-title'></h3>"+
      "<div class='popover-content'></div>"+
      "<div class='popover-navigation'>"+
      "<button class='btn btn-default' data-role='end'>Tutup</button>"+
      "</div>"+
      "</div>"
    });
    tour.init();
    tour.start();
  </script>
<?php endif?>
<?php if(isset($homeStart)): ?>
  <script type="text/javascript">
    var tour = new Tour({
      storage: false,
      steps: [
      {
        element: "#homeStart",
        title: "Mulai",
        content: "Silakan klik tombol disamping untuk memulai"
      }],
      template: "<div class='popover tour'>"+
      "<div class='arrow'></div>"+
      "<h3 class='popover-title'></h3>"+
      "<div class='popover-content'></div>"+
      "<div class='popover-navigation'>"+
      "<button class='btn btn-default' data-role='end'>Tutup</button>"+
      "</div>"+
      "</div>"
    });
    tour.init();
    tour.start();
  </script>
<?php endif?>
<?php if(isset($loginPage)): ?>
  <script type="text/javascript">
    var tour = new Tour({
      storage: false,
      steps: [
      {
        element: "#inputNIS",
        title: "Masuk",
        content: "Masukan NIS Anda",

      },
      {
        element: "#loginSubmit",
        title: "Masuk",
        content: "Tekan Submit"
      }
      ],
    });
    tour.init();
    tour.start();
  </script>
<?php endif?>
<?php if(isset($selectedPage)): ?>
  <script type="text/javascript">
    var tour = new Tour({
      backdrop: false,
      storage: false,
      steps: [
      {
        container: "body",
        element: "#inputSaran",
        placement: "top",
        title: "Pilih",
        content: "Masukan saran Anda ke calon Osis pilihan Anda ( Opsional ). <br><br>Anda bisa langsung next/melewati step ini"
      },
      {
        element: "#pilihButton",
        title: "Pilih",
        placement: "top",
        content: "Tekan Pilih untuk menyelesaikan"
      }
      ],
    });
    tour.init();
    tour.start();
  </script>
<?php endif?>
</body>
</html>