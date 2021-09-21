<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="panel panel-default">
                        
                        <div class="panel-body">
                            <canvas id="canvas" height="280" width="600"></canvas>
                        </div>
                    </div>
                </div>
            </div>
    </div>


    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>
    <script>
        var year = <?php echo $year; ?>;
        var user = <?php echo $user; ?>;
        var barChartData = {
            labels: year,
            datasets: [{
                label: 'Product',
                backgroundColor: "#8f7878",
                data: user
            }]
        };

        window.onload = function() {
            var ctx = document.getElementById("canvas").getContext("2d");
            window.myBar = new Chart(ctx, {
                type: 'bar',
                data: barChartData,
                options: {
                    elements: {
                        rectangle: {
                            borderWidth: 2,
                            borderSkipped: 'bottom'
                        }
                    },
                    responsive: true,
                    title: {
                        display: true,
                        text: 'แผนภูมิรายได้ของแต่ละสินค้า'
                    }
                }
            });
        };
    </script>


    
    
</div>
