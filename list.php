<!DOCTYPE html>

 <?php
    //$sql_getPwd = "SELECT * FROM users WHERE name"

    
 ?>



<html>
    <head>
        <meta charset="UTF-8">
        <meta lang="en">
        <title>List of words</title>
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body>
        <section class="top">
            <h1>English - Czech</h1>
            <div class="right-bar">
                <form action="/">
                    <input type="submit" class="exit-btn" value="BACK">
                </form>
            </div>
            <div class="left-bar">
                <form action="list.php">
                    <label for="search"><b>Search: </b></label>
                    <input type="text" id="search">
                    <input type="submit" class="btn">
                </form>
                <div class="sort-radio">
                    <form action="list.php">
                        <b>Sort by:</b>
                        <input type="radio" id="sort-name" name="sort" value="name">
                        <label for="sort-name">Name</label>
                        <input type="radio" id="sort-date" name="sort" value="date">
                        <label for="sort-date">Date</label>
                        <input type="submit" class="btn">
                    </form>
                </div>
                <br>

                <form action="add.html">
                    <input type="hidden" name="user" value="">
                    <input type="submit" value="Add words" class="main-btn">
                </form>
                
            </div>
        </section>

        <section class="words">

        </section>
    </body>
</html>