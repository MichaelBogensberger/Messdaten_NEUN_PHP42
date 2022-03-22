<div class="container">
    
    <div class="row">
        <h2>Awesome Wetterstation</h2>
    </div>
    <div class="row">
        <p class="form-inline">
            <select class="form-control" id="station_select"  name="station_id" style="width: 200px">
                <?php
                foreach($model as $station):
                    echo '<option value="' . $station->getId() . '">' . $station->getName() . ' - ' . $station->getId() . '</option>';
                endforeach;
                ?>
            </select>
            <button id="btnSearch" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span>Messwerte anzeigen</button>
            <a id="station_view" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span> Messstation anzeigen</a>
            <a id="station_edit" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span> Messstation bearbeiten</a>
            <a id="station_add" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span> Messstation anlegen</a>

            <button onclick="exportAsCsv()"  class="btn btn-success">Export as CSV</button> <br>

            <!-- HTML UND CSS IS HIN UND WIEDER BRUTAL ******** -->
            <div id="canvasHolder" class="">
                <canvas id="myChart" width="800" height="400"></canvas>
            </div>



        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>Zeitpunkt</th>
                <th>Temperatur [C°]</th>
                <th>Regenmenge [ml]</th>
                <th></th>
            </tr>
            </thead>
            <tbody id="measurements">




            </tbody>
        </table>
    </div>
</div> <!-- /container -->



<script>


            function exportAsCsv() {
                id = $( "#station_select option:selected" ).val();

                $.ajax({
                url: "http://localhost/NEUN/Messdaten_NEUN_PHP42/api/station/" + id + "/measurement",
                success: function(data){ 

                    var csv = data.map(function(d){
                        return JSON.stringify(d);
                        })
                        .join('\n') 
                        .replace(/(^\[)|(\]$)/mg, '');
                        str = csv.replace(/[{}]/g,"");
                        str = str.replace(/"/g, '');
                        str = str.replace(/id:/g, '');
                        str = str.replace(/time:/g, '');
                        str = str.replace(/temperature:/g, '');
                        str = str.replace(/station:/g, '');
                        str = str.replace(/rain:/g, '');
                        str = str.replace(/,/g, ';');
                        str = "ID;Time;Temperature;Rain;Station;\n" + str;
     

                    var hiddenElement = document.createElement('a');
                    hiddenElement.href = 'data:text/csv;charset=utf-8,' + encodeURI(str);
                    hiddenElement.target = '_blank';
                    hiddenElement.download = 'messdaten.csv';
                    hiddenElement.click();


                },
                error: function(){
                    alert("There was an error.");
                }
            });
            }





    $(document).ready(function() {

        loadWerte($( "#station_select option:selected" ).val());


        $( "#station_edit" ).click(function() {

            //alert($( "#station_select option:selected" ).val());

            window.location.href = "index.php?r=station/update&id="+$( "#station_select option:selected" ).val();
        });

        $( "#station_view" ).click(function() {
            window.location.href = "index.php?r=station/view&id="+$( "#station_select option:selected" ).val();
        });
        
        $( "#station_add" ).click(function() {
            window.location.href = "index.php?r=station/create";
        });

        $( "#btnSearch" ).click(function() {
        //alert($( "#station_select option:selected" ).val());

        loadWerte($( "#station_select option:selected" ).val());

        });




        
        





        function loadWerte($id) {

            $.ajax({
                url: "http://localhost/NEUN/Messdaten_NEUN_PHP42/api/station/" + $id + "/measurement",
                success: function(data){ 
                    //console.log(data);

                    var xValues = [];
                    var rain = [];
                    var temp = [];

                    $('#myChart').remove(); // this is my <canvas> element
                    $('#canvasHolder').append('<canvas id="myChart"><canvas>');

                    $('#measurements').children().remove();
                        for (var key in data) {
                            $('table').append('<tr><td>'+ data[key].time +'</td><td>'+ data[key].temperature +'</td><td>'+ data[key].rain +'</td><td><a href="index.php?r=measurement/update&id=' + data[key].id + '"><button class="btn btn-primary"><i class="fa fa-edit"></i></button></a><a href="index.php?r=measurement/delete&id=' + data[key].id + '"><button class="btn btn-danger ml5"><i class="fa fa-trash"></i></button></a></td></tr>');
                            xValues.push(data[key].time);
                            rain.push(data[key].rain);
                            temp.push(data[key].temperature);
                        }

                        var ctx = document.getElementById('myChart').getContext('2d');

                        var myChart = new Chart(ctx, {
                                type: "line",
                                data: {
                                    labels: xValues,
                                    datasets: [{
                                        label: 'Temperature',
                                        data: temp,
                                        yAxisID: 'A',
                                        borderColor: "red",
                                        fill: false
                                    },{
                                        label: 'Rain',
                                        data: rain,
                                        yAxisID: 'B',
                                        borderColor: "blue",
                                        fill: false
                                    }]
                                },
                                options: {
                                    scales: {
                                    yAxes: [{
                                        id: 'A',
                                        type: 'linear',
                                        position: 'left',
                                    }, {
                                        id: 'B',
                                        type: 'linear',
                                        position: 'right',
                                        ticks: {
                                            max: 8,
                                            min: 0
                                        }
                                    }]
                                    }
                                }
                        });

                },
                error: function(){
                    alert("There was an error.");
                }
            });

        }
    });

</script>


