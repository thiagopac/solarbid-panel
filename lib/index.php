<?
   // #INCLUDES
   require_once ('../lib/config.php');

   // CONTROLE SESSAO
   include('../imports/header.php');
   ?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
<div class="page-content">

  <div class="row">
    <div class="col-md-12 page-404">
      <div class="number">
         404
      </div>
      <div class="details">
        <h3><?= $t->{'Oops! You`re lost.'}; ?></h3>
        <p>
           <?= $t->{'We can not find the page you`re looking for.'}; ?><br/>
           <?= $t->{'You may have accessed a non-existent page or content belonging to the other person.'}; ?><br/>
           <br/>
          <a onclick="window.history.go(-1)">
          <?= $t->{'Return'}; ?> </a>
          <?= $t->{'to the last page you were on.'}; ?>
        </p>
      </div>
    </div>
  </div>

<!-- END CONTENT -->
</div>
<? include('../imports/footer.php'); ?>
</body>
</html>
