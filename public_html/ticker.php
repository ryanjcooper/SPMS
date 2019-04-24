<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" type="text/css" href="global_assets/dashboard.css">
        <link rel="stylesheet" type="text/css" href="global_assets/header.css">

        <title>Stock Overflow</title>
        <link rel="icon" href="./global_assets/img/favicon.png" type="image/png">

        <!-- CDN stuff for Bootstrap -->
        <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>

        <div class="header_div navbar-spacers">
            <?php include "header.php"; ?>
            <!-- Use jquery to insert header content here if PHP fails    -->
        </div>
        
        <div id="feedback">
            
        </div>

        <!-- Body of ticker -->
        <div class="">
                        <div class="row">
                                <div class="offset-lg-2 col-lg-5 bar-right">
                                        <h3 id="company_name">Stock Name Here</h3>
                                        <img src="global_assets/img/graph.png" class="img-fluid">
                                        <h3 class="text-center">About</h3>
                                        <p id="ticker_about">More info about a stock goes here if available</p>
                                </div>
                                <div class="col-lg-3" id="stock_table_div">
                                        <table class = "table stock_tables">
                                                <!-- Portfolio stock details -->
                                           <tbody>
                                              <th colspan="2">
                                                 <b>Porfolio</b>
                                              </th>
                                              <tr>
                                                 <td>Shares</th>
                                                 <td> SHARE COUNT</th>
                                              </tr>
                                              <tr>
                                                 <td> Date Purchased </td>
                                                 <td> Date </td>
                                              </tr>
                                              <tr>
                                                 <td> Time Purchased </td>
                                                 <td> TIME </td>
                                              </tr>
                                           </tbody>
                                        </table>
                                        <div class="card mt-3 tab-card">
                                                <div class="card-header tab-card-header">
                                                  <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="one-tab" data-toggle="tab" href="#one" role="tab" aria-controls="Buy" aria-selected="true">Buy</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="two-tab" data-toggle="tab" href="#two" role="tab" aria-controls="Sell" aria-selected="false">Sell</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="three-tab" data-toggle="tab" href="#three" role="tab" aria-controls="Watch" aria-selected="false">Watch</a>
                                                    </li>
                                                  </ul>
                                                </div>

                                                <div class="tab-content" id="myTabContent">
                                                  <div class="tab-pane fade show active p-3" id="one" role="tabpanel" aria-labelledby="one-tab">
                                                    <h5 class="card-title">Buy</h5>
                                                    <form class="form-inline">
                                                            <input class="form-control" type="text" placeholder="Amount" id="buycount" style="width:100%"> </input>
                                                    </form>
                                                    <p class="card-text">Here is where you buy a stock.</p>
                                                  </div>
                                                  <div class="tab-pane fade p-3" id="two" role="tabpanel" aria-labelledby="two-tab">
                                                    <h5 class="card-title">Sell</h5>
                                                    <form class="form-inline">
                                                            <input class="form-control" type="text" placeholder="Amount" id="buycount" style="width:100%"> </input>
                                                    </form>
                                                    <p class="card-text">Here is where you sell a stock</p>
                                                  </div>
                                                  <div class="tab-pane fade p-3" id="three" role="tabpanel" aria-labelledby="three-tab">
                                                    <h5 class="card-title">Watchlist</h5>
                                                   <a href="#" class="btn btn-primary">Add</a>   
                                                    <p class="card-text">Add/Remove this stock from your watchlist</p>
                                                  </div>

                                                </div>
                                              </div>

                                        <!-- Statistics -->
                                        <span id='stats_go_here'>Loading stats, please wait...</span>
                                </div>
                                <div class="col-lg-2">
                                </div>
                        </div>

                                                        <!-- NEWS ARTCILES -->
                        <div class="offset-lg-2">
                                <div class="row">
                                        <div class="mx-auto col-lg-6">
                                            <br><br><br><br>
                                                <h3 class="text-center">Relevant articles</h3>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-2">
                                        </div>
                                </div>
                                <div class="row">
                                        <div class="col-lg-2 col-md-2 col-sm-2 my-auto">
                                                <a href="#" class="bg-mute round arrow">Previous &laquo;</a>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6" id="news_articles">

                                                <!-- Article reference format, not displayed -->
                                                <a href="nothing" class="nounderline d-none article_url" id='article_template'>
                                                <div class="card mb-3" style="max-width: 100%;">
                                                  <div class="row no-gutters hoverable">
                                                    <div class="col-md-4 artcile_img">
                                                      <img  src="https://ei.marketwatch.com/Multimedia/2019/04/17/Photos/ZH/MW-HH786_model3_20190417122228_ZH.jpg?uuid=fe15c706-612c-11e9-b5b6-9c8e992d421e" class="hoverable card-img" alt="Image Unavailable">
                                                    </div>
                                                    <div class="col-md-8">
                                                      <div class="card-body">
                                                        <h5 class="card-title artcile_headline"> Tesla Can't Stop Dreaming Big</h5>
                                                        <p class="card-text article_summary">Elon Musk’s ambitions to turn Tesla into a dominant automobile player have become a liability instead of an asset.</p>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                                </a>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-2 my-auto">
                                                <a href="#" class="bg-mute round float-right arrow"> Next &raquo;</a>
                                        </div>
                                </div>

                        </div>

        </div>


<div class="footer_div">
    <?php include "footer.php"; ?>
        <!-- Use jquery to insert header content here if PHP fails    -->
</div>

<script src='script.js'></script>
<script type="text/javascript">
    $(document).ready(function() {
        ticker();
    });
</script>

</body>
</html>
