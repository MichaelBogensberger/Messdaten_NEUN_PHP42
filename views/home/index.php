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
            <button id="btnSearch" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Messwerte anzeigen</button>
            <a id="station_edit" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span> Messstationen bearbeiten</a>

            <button onclick="exportAsCsv()"  class="btn btn-success">Export as CSV</button>


            <canvas id="chart" width="400" height="100"></canvas>

        <br/>





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


        $( "#btnSearch" ).click(function() {
        //alert($( "#station_select option:selected" ).val());

        loadWerte($( "#station_select option:selected" ).val());

        });




        
        





        function loadWerte($id) {

            $.ajax({
                url: "http://localhost/NEUN/Messdaten_NEUN_PHP42/api/station/" + $id + "/measurement",
                success: function(data){ 
                    //console.log(data);
                    $('#measurements').children().remove();
                        for (var key in data) {
                            $('table').append('<tr><td>'+ data[key].time +'</td><td>'+ data[key].temperature +'</td><td>'+ data[key].rain +'</td><td><a href="index.php?r=measurement/update&id=' + data[key].id + '"><button class="btn btn-primary"><i class="fa fa-edit"></i></button></a><button class="btn btn-danger ml5"><i class="fa fa-trash"></i></button></td></tr>');
                        }
                },
                error: function(){
                    alert("There was an error.");
                }
            });

        }






    });

</script>


