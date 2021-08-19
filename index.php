<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="pt" dir="ltr"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang="pt" dir="ltr"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="pt" dir="ltr"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="pt" dir="ltr">
<!--<![endif]-->

<head profile="http://www.w3.org/1999/xhtml/vocab">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

  <title>Simulador</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <link type="text/css" rel="stylesheet" href="./form.css" media="all" />
</head>

<body class="html not-front not-logged-in no-sidebars page-apply page-apply-plusloan customer-not-logged-in fe-country-br i18n-pt not-multilingual">

  <?php
  function calculo($valor, $parcela, $taxa = null)
  {
    switch ($parcela) {
      case 2:
        $coef = 0.613;
        break;
      case 3:
        $coef = 0.437;
        break;
      case 4:
        $coef = 0.350;
        break;
      case 5:
        $coef = 0.298;
        break;
      case 6:
        $coef = 0.264;
        break;
      case 7:
        $coef = 0.240;
        break;
      case 8:
        $coef = 0.224;
        break;
      case 9:
        $coef = 0.211;
        break;
    }
    $valorParcela = $valor * $coef;
    return $valorParcela;
  }
  #echo calculo(1000, 9);

  ##CONFIGURACAO
  $valorMinimo = 400;
  $valorMaximo = 3000;
  $valorIntervalo = 100;
  $valorSelecionado = 1000;

  $parcelasMinino       = 2;
  $parcelasMaximo       = 9;
  $parcelasSelecionado  = 9;

  $fee        = 6;


  $valor_optionHTML = '';
  for ($i = $valorMinimo; $i <= $valorMaximo; $i = $i + $valorIntervalo) {

    $optionSelected = $i === $valorSelecionado ? 'selected' : '';
    $valor_optionHTML .= "<option value='{$i}' {$optionSelected}>R$ {$i}</option>";
  }

  $parcela_optionHTML = '';
  for ($i = $parcelasMinino; $i <= $parcelasMaximo; $i++) {

    $optionSelected = $i === $parcelasSelecionado ? 'selected' : '';
    $parcela_optionHTML .= "<option value='{$i}' {$optionSelected}>{$i} meses</option>";
  }

  $simulaJSON = [];
  for ($valorAtual = $valorMinimo; $valorAtual <= $valorMaximo; $valorAtual = $valorAtual + $valorIntervalo) {
    for ($parcelaAtual = $parcelasMinino; $parcelaAtual <= $parcelasMaximo; $parcelaAtual++) {

      $simulaJSON["{$valorAtual}-{$parcelaAtual}"] = ["monthlyPayment" => calculo($valorAtual, $parcelaAtual)];
    }
  }
  $simulaJSON = json_encode($simulaJSON);

  ?>
  <div class="main-container-inner container no-title">
    <div class="row">
      <section class="col-sm-12">
        <a id="main-content"></a>

        <div class="main-container-inner-content">
          <div class="region region-content">
            <section id="block-system-main" class="block block-system clearfix">

              <form autocomplete="off" class="form-with-slider application-form mask-form" action="/apply/credit" method="post" id="fe-process-br-lead-form" accept-charset="UTF-8">
                <div>
                  <div class="fe-plcalc-slider-container">
                    <div class="br-plcalc">
                      <section class="calc-slider calc-slider-pl-amount">
                        <div class="calc-amount">
                          <div class="calc-options slider-status hidden">
                            <div class="form-type-select form-item-pl-amount form-item form-group">
                              <select class="form-control form-select" id="edit-pl-amount" name="pl_amount">
                                <?= $valor_optionHTML ?>
                              </select>
                              <p class="help-block"></p>
                            </div>
                          </div>
                        </div>
                        <div class="form-type-input-range form-item-pl-amount-range form-item form-group">
                          <label for="amount-slider">De quanto você precisa? <span class="form-required-icon">&nbsp;</span></label>

                          <input type="range" id="amount-slider" name="pl_amount_range" min="<?= $valorMinimo?>" max="<?= $valorMaximo?>" step="<?= $valorIntervalo?>" value="<?= $valorSelecionado?>" class="form-range">
                          <div class="range">
                            <small class="range-value min pull-left">R$ <?= number_format($valorMinimo, 2, ',', '.') ?></small>
                            <small class="range-value max pull-right">R$ <?= number_format($valorMaximo, 2, ',', '.') ?></small>
                          </div>

                          <p class="help-block"></p>
                        </div>
                      </section>

                      <section class="calc-slider calc-slider-pl-term">
                        <div class="calc-term">
                          <div class="calc-options slider-status hidden">
                            <div class="form-type-select form-item-pl-term form-item form-group">
                              <select class="form-control form-select" id="edit-pl-term" name="pl_term">
                                <?= $parcela_optionHTML ?>
                              </select>
                              <p class="help-block"></p>
                            </div>
                          </div>
                        </div>
                        <div class="form-type-input-range form-item-pl-term-range form-item form-group">
                          <label for="term-slider">Em quantas parcelas? <span class="form-required-icon">&nbsp;</span></label>

                          <input type="range" id="term-slider" name="pl_term_range" min="2" max="9" step="1" value="9" class="form-range">
                          <div class="range">
                            <small class="range-value min pull-left">2</small>
                            <small class="range-value max pull-right">9</small>
                          </div>

                          <p class="help-block"></p>
                        </div>
                      </section>

                      <div class="calc-loan-info">
                        <section id="block-boxes-plcalc-loan-info-pt" class="block block-boxes block-boxes-simple calc-description-box box-pt clearfix">


                          <div id='boxes-box-plcalc_loan_info_pt' class='boxes-box'>
                            <div class="boxes-box-content">
                              <p class="rtecenter"><strong>Parcela mensal: <span class="plcalc-replace-monthly-payment">X</span></strong></p>
                            </div>
                          </div>
                        </section>
                      </div>

                      <div class="calc-actions">
                      </div>

                      <div class="calc-note"></div>

                      <div class="calc-footer">
                      </div>


                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-8">
                      <section id="block-boxes-loan-info-pt" class="block block-boxes block-boxes-simple info-box loan-info-box clearfix">

                        <h2 class="block-title">Detalhes do seu empréstimo</h2>

                        <div id='boxes-box-loan_info_pt' class='boxes-box'>
                          <div class="boxes-box-content">
                            <div class="row">
                              <div class="col-sm-4"><span class="calc-heading">Valor </span><b><span class="calc-number">R$ 1.000,00</span></b></div>

                              <div class="col-sm-4"><span class="calc-heading">Parcelas </span><b><span class="calc-number">9 meses</span></b></div>

                              <div class="col-sm-4"><span class="calc-heading">Parcela </span><b><span class="calc-number">R$ 210,16</span></b></div>
                            </div>
                          </div>
                        </div>
                      </section>
                    </div>
                    <div class="col-md-4">
                      <section id="block-boxes-pl-loan-details-help-pt" class="block block-boxes block-boxes-simple loan-tax-info info-box clearfix">


                        <div id='boxes-box-pl_loan_details_help_pt' class='boxes-box'>
                          <div class="boxes-box-content">
                            <p>Tarifas <strong>6,00%</strong></p>
                            <p>IOF <strong>R$ 16,16</strong></p>
                            <p>Taxa de juros mensal <strong>14,90%</strong> * (CET: <strong>17,15%</strong>)</p>
                            <p>Taxa de juros anual <strong>429,47%</strong> (CET: <strong>568,20%</strong>)</p>
                            <p>*Taxa pode variar de 9,9% até 17,9% a.m. Sua taxa será exibida na última página, após analise de crédito.</p>
                          </div>
                        </div>
                      </section>
                    </div>
                  </div>


                </div>
              </form>
            </section>
          </div>
        </div>
      </section>


    </div>
  </div>


  <script src="./jquery3.5.1.js"></script>
  <script>
    jQuery.extend(Drupal.settings, {
      "masterTravel_currency": "R$ ",
      "masterTravel_date_format": "dd.MM.yyyy",
      "masterTravel_money_decimals": 2,
      "masterTravel_thousands_sep": ".",
      "masterTravel_dec_point": ",",
      "calc": {
        "range": {
          "pl": {
            "amount": {
              "min": "<?= $valorMinimo?>",
              "max": "<?= $valorMaximo?>"
            },
            "term": {
              "min": "<?= $parcelasMinino?>",
              "max": "<?= $parcelasMaximo?>"
            }
          }
        },
        "pl": {
          "loan_table": <?= $simulaJSON?>
        }
      },

    });
  </script>

  <script src="./form.js"></script>

</body>

</html>