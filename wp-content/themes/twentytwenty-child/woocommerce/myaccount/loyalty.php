<h2>Our loyalty program</h2>

<?php
$current_user = wp_get_current_user();

$points = get_user_meta($current_user->ID, "points")[0];

// add_filter( 'the_title', 'wc_page_endpoint_title' );
// the_title( '<h2>', '</h2>' );

//   dd($points);
?>
<div class="container">
    <div class="row">
        <div class="col-6">
            <h2>ici genère des codes promo </h2>
        </div>

    </div>
    <div class="row">
        <div class="col-12 ">
            <div class="position-relative   d-flex justify-content-center align-items-center" style="min-height:200px ;">
                <div class="border  border-2 rounded-circle border-5 border-info  " style="padding:30px 35px ;">
                    <p class="text-success pt-2 text-center fw-bold" style="font-size: 45px;"><?php echo $points  ?> <br> <span class="fs-6 position-absolute start-0 end-0 text-dark ">points </span> </p>

                </div>
            </div>

        </div>
        <div class="col-6">
            <label for="customRange2" class="form-label">Example range</label>
            <input type="range" class="form-range" min="0" max="5" id="customRange2">
        </div>
    </div>
    <style>
.angry-grid {
   display: grid; 

   grid-template-rows: 1fr 1fr;
   grid-template-columns: 1fr 1fr;
   
   gap: 0px;
   height: 100%;
   
}
  
#item-0 {
    height: 100%!important;
   background-color: #9B95A9; 
   grid-row-start: 1;
   grid-column-start: 1;

   grid-row-end: 3;
   grid-column-end: 2;
   grid-template-columns: auto-fill;

   
   
}
#item-1 {

   background-color: #ce9666; 
   grid-row-start: 2;
   grid-column-start: 2;

   grid-row-end: 3;
   grid-column-end: 3;
   grid-template-columns: auto-fill;
   
}
#item-2 {

   background-color: #9aed57; 
   grid-row-start: 1;
   grid-column-start: 2;

   grid-row-end: 2;
   grid-column-end: 3;
   grid-template-columns: auto-fill;

   
}
</style>
    <div class="row card border border-1 border-primary rounded-3  p-5 d-flex flex-row justify-content-center align-items-center" style="
        background:url('http://localhost/veterino/wp-content/uploads/2022/08/Plan-de-travail-1.jpg');
        background-size:cover;
        ">
        <div class="col-6 d-flex flex-column justify-content-center align-items-center bg-info  h-100">
            <h1 style="font-size: 75px;">50 % </h1>
            <!-- <hr class="my-5">
            <p class="mt-5 pt-5">
                <small>mariam le gros bebe cadum grous prout </small>

            </p> -->

        </div>
        <div class="col-6 d-flex justify-content-center align-items-center  bg-success h-100">
            <h1 style="font-size: 75px;">50 %</h1>


        </div>
    </div>

    <div class="row card border border-1 border-primary rounded-3  p-5" style="
        background:url('http://localhost/veterino/wp-content/uploads/2022/08/Plan-de-travail-1.jpg');
        background-size:cover;
        ">
        <div class="angry-grid">
            <div id="item-0">
            <div class="h-100 d-flex flex-column justify-content-center align-items-center bg-info  ">
            <h1 style="font-size: 75px;">50 % </h1>
            <hr class="mys-5">
            <p class="mt-5 pt-5">
                <small>mariam le gros bebe cadum grous prout </small>

            </p>

        </div>
            </div>
            <div id="item-1">

            
            </div>
            <div id="item-2">OKEYYYY MANIOLO</div>

        </div>

    </div>


</div>