<main>
    <input id="tab1" type="radio" name="tabs" checked>
    <label for="tab1">Processing Order</label>
    
    <input id="tab2" type="radio" name="tabs">
    <label for="tab2">Delivered Order</label>

    <input id="tab3" type="radio" name="tabs">
    <label for="tab3">Customers</label>
    
    <input id="tab4" type="radio" name="tabs">
    <label for="tab4">Maintenance</label>

    <input id="tab5" type="radio" name="tabs">
    <label for="tab5">Products</label>
    
    <section id="content1">
        <?php
        include('inc/admin/tables/processingOrderTable.html');
        ?>
    </section>
        
    <section id="content2">
        <?php
        include('inc/admin/tables/deliveredOrderTable.html');
        ?>
    </section> 

    <section id="content3">
        <?php
        include('inc/admin/tables/userTable.html');
        ?>
    </section> 

    <section id="content4">
        <?php
        include('inc/admin/tables/mainTable.html');
        ?>
    </section> 

    <section id="content5">
        <?php
        include('inc/admin/tables/product.html');
        ?>
    </section> 
</main>