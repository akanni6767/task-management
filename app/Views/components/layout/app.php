<?= $this->include("components/templates/header.php"); ?>
    <div class="doc_wrapper">

        <!-- SIDEBAR -->
        <section class="sidebar">
            <?= $this->include("components/templates/sidebar.php"); ?>
        </section>

        <!-- BODY -->
         <section id="main">
            <?= $this->renderSection("content"); ?>
         </section>
         
        <?= $this->include("components/templates/modals.php"); ?>
    </div>
    <!-- FOOTER -->
<?= $this->include("components/templates/footer.php"); ?>