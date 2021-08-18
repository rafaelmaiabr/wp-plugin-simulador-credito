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
    $valorParcela = number_format($valor * $coef, 2, ',', '.');
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

                          <input type="range" id="amount-slider" name="pl_amount_range" min="400" max="3000" step="100" value="1000" class="form-range">
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
                                <?= $parcela_optionHTML?>
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
              "min": "400",
              "max": "3000"
            },
            "term": {
              "min": "2",
              "max": "9"
            }
          }
        },
        "pl": {
          "loan_table": {
            "400-2": {
              "monthlyPayment": 245.13,
              "amount": "400",
              "term": "2",
              "fee": 6
            },
            "400-3": {
              "monthlyPayment": 174.7,
              "amount": "400",
              "term": "3",
              "fee": 6
            },
            "400-4": {
              "monthlyPayment": 139.83,
              "amount": "400",
              "term": "4",
              "fee": 6
            },
            "400-5": {
              "monthlyPayment": 119.2,
              "amount": "400",
              "term": "5",
              "fee": 6
            },
            "400-6": {
              "monthlyPayment": 105.68,
              "amount": "400",
              "term": "6",
              "fee": 6
            },
            "400-7": {
              "monthlyPayment": 96.22,
              "amount": "400",
              "term": "7",
              "fee": 6
            },
            "400-8": {
              "monthlyPayment": 89.3,
              "amount": "400",
              "term": "8",
              "fee": 6
            },
            "400-9": {
              "monthlyPayment": 84.06,
              "amount": "400",
              "term": "9",
              "fee": 6
            },
            "500-2": {
              "monthlyPayment": 306.42,
              "amount": "500",
              "term": "2",
              "fee": 6
            },
            "500-3": {
              "monthlyPayment": 218.38,
              "amount": "500",
              "term": "3",
              "fee": 6
            },
            "500-4": {
              "monthlyPayment": 174.8,
              "amount": "500",
              "term": "4",
              "fee": 6
            },
            "500-5": {
              "monthlyPayment": 149,
              "amount": "500",
              "term": "5",
              "fee": 6
            },
            "500-6": {
              "monthlyPayment": 132.1,
              "amount": "500",
              "term": "6",
              "fee": 6
            },
            "500-7": {
              "monthlyPayment": 120.28,
              "amount": "500",
              "term": "7",
              "fee": 6
            },
            "500-8": {
              "monthlyPayment": 111.63,
              "amount": "500",
              "term": "8",
              "fee": 6
            },
            "500-9": {
              "monthlyPayment": 105.08,
              "amount": "500",
              "term": "9",
              "fee": 6
            },
            "600-2": {
              "monthlyPayment": 367.7,
              "amount": "600",
              "term": "2",
              "fee": 6
            },
            "600-3": {
              "monthlyPayment": 262.05,
              "amount": "600",
              "term": "3",
              "fee": 6
            },
            "600-4": {
              "monthlyPayment": 209.75,
              "amount": "600",
              "term": "4",
              "fee": 6
            },
            "600-5": {
              "monthlyPayment": 178.8,
              "amount": "600",
              "term": "5",
              "fee": 6
            },
            "600-6": {
              "monthlyPayment": 158.52,
              "amount": "600",
              "term": "6",
              "fee": 6
            },
            "600-7": {
              "monthlyPayment": 144.33,
              "amount": "600",
              "term": "7",
              "fee": 6
            },
            "600-8": {
              "monthlyPayment": 133.95,
              "amount": "600",
              "term": "8",
              "fee": 6
            },
            "600-9": {
              "monthlyPayment": 126.1,
              "amount": "600",
              "term": "9",
              "fee": 6
            },
            "700-2": {
              "monthlyPayment": 428.98,
              "amount": "700",
              "term": "2",
              "fee": 6
            },
            "700-3": {
              "monthlyPayment": 305.73,
              "amount": "700",
              "term": "3",
              "fee": 6
            },
            "700-4": {
              "monthlyPayment": 244.71,
              "amount": "700",
              "term": "4",
              "fee": 6
            },
            "700-5": {
              "monthlyPayment": 208.6,
              "amount": "700",
              "term": "5",
              "fee": 6
            },
            "700-6": {
              "monthlyPayment": 184.94,
              "amount": "700",
              "term": "6",
              "fee": 6
            },
            "700-7": {
              "monthlyPayment": 168.39,
              "amount": "700",
              "term": "7",
              "fee": 6
            },
            "700-8": {
              "monthlyPayment": 156.28,
              "amount": "700",
              "term": "8",
              "fee": 6
            },
            "700-9": {
              "monthlyPayment": 147.11,
              "amount": "700",
              "term": "9",
              "fee": 6
            },
            "800-2": {
              "monthlyPayment": 490.27,
              "amount": "800",
              "term": "2",
              "fee": 6
            },
            "800-3": {
              "monthlyPayment": 349.4,
              "amount": "800",
              "term": "3",
              "fee": 6
            },
            "800-4": {
              "monthlyPayment": 279.67,
              "amount": "800",
              "term": "4",
              "fee": 6
            },
            "800-5": {
              "monthlyPayment": 238.41,
              "amount": "800",
              "term": "5",
              "fee": 6
            },
            "800-6": {
              "monthlyPayment": 211.36,
              "amount": "800",
              "term": "6",
              "fee": 6
            },
            "800-7": {
              "monthlyPayment": 192.45,
              "amount": "800",
              "term": "7",
              "fee": 6
            },
            "800-8": {
              "monthlyPayment": 178.6,
              "amount": "800",
              "term": "8",
              "fee": 6
            },
            "800-9": {
              "monthlyPayment": 168.13,
              "amount": "800",
              "term": "9",
              "fee": 6
            },
            "900-2": {
              "monthlyPayment": 551.55,
              "amount": "900",
              "term": "2",
              "fee": 6
            },
            "900-3": {
              "monthlyPayment": 393.08,
              "amount": "900",
              "term": "3",
              "fee": 6
            },
            "900-4": {
              "monthlyPayment": 314.63,
              "amount": "900",
              "term": "4",
              "fee": 6
            },
            "900-5": {
              "monthlyPayment": 268.2,
              "amount": "900",
              "term": "5",
              "fee": 6
            },
            "900-6": {
              "monthlyPayment": 237.78,
              "amount": "900",
              "term": "6",
              "fee": 6
            },
            "900-7": {
              "monthlyPayment": 216.5,
              "amount": "900",
              "term": "7",
              "fee": 6
            },
            "900-8": {
              "monthlyPayment": 200.92,
              "amount": "900",
              "term": "8",
              "fee": 6
            },
            "900-9": {
              "monthlyPayment": 189.15,
              "amount": "900",
              "term": "9",
              "fee": 6
            },
            "1000-2": {
              "monthlyPayment": 612.83,
              "amount": "1000",
              "term": "2",
              "fee": 6
            },
            "1000-3": {
              "monthlyPayment": 436.75,
              "amount": "1000",
              "term": "3",
              "fee": 6
            },
            "1000-4": {
              "monthlyPayment": 349.59,
              "amount": "1000",
              "term": "4",
              "fee": 6
            },
            "1000-5": {
              "monthlyPayment": 298.01,
              "amount": "1000",
              "term": "5",
              "fee": 6
            },
            "1000-6": {
              "monthlyPayment": 264.2,
              "amount": "1000",
              "term": "6",
              "fee": 6
            },
            "1000-7": {
              "monthlyPayment": 240.56,
              "amount": "1000",
              "term": "7",
              "fee": 6
            },
            "1000-8": {
              "monthlyPayment": 223.25,
              "amount": "1000",
              "term": "8",
              "fee": 6
            },
            "1000-9": {
              "monthlyPayment": 210.16,
              "amount": "1000",
              "term": "9",
              "fee": 6
            },
            "1100-2": {
              "monthlyPayment": 674.11,
              "amount": "1100",
              "term": "2",
              "fee": 6
            },
            "1100-3": {
              "monthlyPayment": 480.43,
              "amount": "1100",
              "term": "3",
              "fee": 6
            },
            "1100-4": {
              "monthlyPayment": 384.55,
              "amount": "1100",
              "term": "4",
              "fee": 6
            },
            "1100-5": {
              "monthlyPayment": 327.81,
              "amount": "1100",
              "term": "5",
              "fee": 6
            },
            "1100-6": {
              "monthlyPayment": 290.63,
              "amount": "1100",
              "term": "6",
              "fee": 6
            },
            "1100-7": {
              "monthlyPayment": 264.62,
              "amount": "1100",
              "term": "7",
              "fee": 6
            },
            "1100-8": {
              "monthlyPayment": 245.57,
              "amount": "1100",
              "term": "8",
              "fee": 6
            },
            "1100-9": {
              "monthlyPayment": 231.18,
              "amount": "1100",
              "term": "9",
              "fee": 6
            },
            "1200-2": {
              "monthlyPayment": 735.4,
              "amount": "1200",
              "term": "2",
              "fee": 6
            },
            "1200-3": {
              "monthlyPayment": 524.1,
              "amount": "1200",
              "term": "3",
              "fee": 6
            },
            "1200-4": {
              "monthlyPayment": 419.51,
              "amount": "1200",
              "term": "4",
              "fee": 6
            },
            "1200-5": {
              "monthlyPayment": 357.61,
              "amount": "1200",
              "term": "5",
              "fee": 6
            },
            "1200-6": {
              "monthlyPayment": 317.04,
              "amount": "1200",
              "term": "6",
              "fee": 6
            },
            "1200-7": {
              "monthlyPayment": 288.67,
              "amount": "1200",
              "term": "7",
              "fee": 6
            },
            "1200-8": {
              "monthlyPayment": 267.9,
              "amount": "1200",
              "term": "8",
              "fee": 6
            },
            "1200-9": {
              "monthlyPayment": 252.19,
              "amount": "1200",
              "term": "9",
              "fee": 6
            },
            "1300-2": {
              "monthlyPayment": 796.68,
              "amount": "1300",
              "term": "2",
              "fee": 6
            },
            "1300-3": {
              "monthlyPayment": 567.78,
              "amount": "1300",
              "term": "3",
              "fee": 6
            },
            "1300-4": {
              "monthlyPayment": 454.47,
              "amount": "1300",
              "term": "4",
              "fee": 6
            },
            "1300-5": {
              "monthlyPayment": 387.41,
              "amount": "1300",
              "term": "5",
              "fee": 6
            },
            "1300-6": {
              "monthlyPayment": 343.47,
              "amount": "1300",
              "term": "6",
              "fee": 6
            },
            "1300-7": {
              "monthlyPayment": 312.72,
              "amount": "1300",
              "term": "7",
              "fee": 6
            },
            "1300-8": {
              "monthlyPayment": 290.22,
              "amount": "1300",
              "term": "8",
              "fee": 6
            },
            "1300-9": {
              "monthlyPayment": 273.21,
              "amount": "1300",
              "term": "9",
              "fee": 6
            },
            "1400-2": {
              "monthlyPayment": 857.96,
              "amount": "1400",
              "term": "2",
              "fee": 6
            },
            "1400-3": {
              "monthlyPayment": 611.45,
              "amount": "1400",
              "term": "3",
              "fee": 6
            },
            "1400-4": {
              "monthlyPayment": 489.43,
              "amount": "1400",
              "term": "4",
              "fee": 6
            },
            "1400-5": {
              "monthlyPayment": 417.21,
              "amount": "1400",
              "term": "5",
              "fee": 6
            },
            "1400-6": {
              "monthlyPayment": 369.89,
              "amount": "1400",
              "term": "6",
              "fee": 6
            },
            "1400-7": {
              "monthlyPayment": 336.78,
              "amount": "1400",
              "term": "7",
              "fee": 6
            },
            "1400-8": {
              "monthlyPayment": 312.55,
              "amount": "1400",
              "term": "8",
              "fee": 6
            },
            "1400-9": {
              "monthlyPayment": 294.23,
              "amount": "1400",
              "term": "9",
              "fee": 6
            },
            "1500-2": {
              "monthlyPayment": 919.25,
              "amount": "1500",
              "term": "2",
              "fee": 6
            },
            "1500-3": {
              "monthlyPayment": 655.13,
              "amount": "1500",
              "term": "3",
              "fee": 6
            },
            "1500-4": {
              "monthlyPayment": 524.38,
              "amount": "1500",
              "term": "4",
              "fee": 6
            },
            "1500-5": {
              "monthlyPayment": 447.01,
              "amount": "1500",
              "term": "5",
              "fee": 6
            },
            "1500-6": {
              "monthlyPayment": 396.31,
              "amount": "1500",
              "term": "6",
              "fee": 6
            },
            "1500-7": {
              "monthlyPayment": 360.84,
              "amount": "1500",
              "term": "7",
              "fee": 6
            },
            "1500-8": {
              "monthlyPayment": 334.87,
              "amount": "1500",
              "term": "8",
              "fee": 6
            },
            "1500-9": {
              "monthlyPayment": 315.24,
              "amount": "1500",
              "term": "9",
              "fee": 6
            },
            "1600-2": {
              "monthlyPayment": 980.53,
              "amount": "1600",
              "term": "2",
              "fee": 6
            },
            "1600-3": {
              "monthlyPayment": 698.81,
              "amount": "1600",
              "term": "3",
              "fee": 6
            },
            "1600-4": {
              "monthlyPayment": 559.35,
              "amount": "1600",
              "term": "4",
              "fee": 6
            },
            "1600-5": {
              "monthlyPayment": 476.81,
              "amount": "1600",
              "term": "5",
              "fee": 6
            },
            "1600-6": {
              "monthlyPayment": 422.73,
              "amount": "1600",
              "term": "6",
              "fee": 6
            },
            "1600-7": {
              "monthlyPayment": 384.89,
              "amount": "1600",
              "term": "7",
              "fee": 6
            },
            "1600-8": {
              "monthlyPayment": 357.2,
              "amount": "1600",
              "term": "8",
              "fee": 6
            },
            "1600-9": {
              "monthlyPayment": 336.26,
              "amount": "1600",
              "term": "9",
              "fee": 6
            },
            "1700-2": {
              "monthlyPayment": 1041.82,
              "amount": "1700",
              "term": "2",
              "fee": 6
            },
            "1700-3": {
              "monthlyPayment": 742.48,
              "amount": "1700",
              "term": "3",
              "fee": 6
            },
            "1700-4": {
              "monthlyPayment": 594.3,
              "amount": "1700",
              "term": "4",
              "fee": 6
            },
            "1700-5": {
              "monthlyPayment": 506.61,
              "amount": "1700",
              "term": "5",
              "fee": 6
            },
            "1700-6": {
              "monthlyPayment": 449.15,
              "amount": "1700",
              "term": "6",
              "fee": 6
            },
            "1700-7": {
              "monthlyPayment": 408.95,
              "amount": "1700",
              "term": "7",
              "fee": 6
            },
            "1700-8": {
              "monthlyPayment": 379.52,
              "amount": "1700",
              "term": "8",
              "fee": 6
            },
            "1700-9": {
              "monthlyPayment": 357.28,
              "amount": "1700",
              "term": "9",
              "fee": 6
            },
            "1800-2": {
              "monthlyPayment": 1103.1,
              "amount": "1800",
              "term": "2",
              "fee": 6
            },
            "1800-3": {
              "monthlyPayment": 786.15,
              "amount": "1800",
              "term": "3",
              "fee": 6
            },
            "1800-4": {
              "monthlyPayment": 629.26,
              "amount": "1800",
              "term": "4",
              "fee": 6
            },
            "1800-5": {
              "monthlyPayment": 536.41,
              "amount": "1800",
              "term": "5",
              "fee": 6
            },
            "1800-6": {
              "monthlyPayment": 475.57,
              "amount": "1800",
              "term": "6",
              "fee": 6
            },
            "1800-7": {
              "monthlyPayment": 433.01,
              "amount": "1800",
              "term": "7",
              "fee": 6
            },
            "1800-8": {
              "monthlyPayment": 401.85,
              "amount": "1800",
              "term": "8",
              "fee": 6
            },
            "1800-9": {
              "monthlyPayment": 378.29,
              "amount": "1800",
              "term": "9",
              "fee": 6
            },
            "1900-2": {
              "monthlyPayment": 1164.38,
              "amount": "1900",
              "term": "2",
              "fee": 6
            },
            "1900-3": {
              "monthlyPayment": 829.83,
              "amount": "1900",
              "term": "3",
              "fee": 6
            },
            "1900-4": {
              "monthlyPayment": 664.22,
              "amount": "1900",
              "term": "4",
              "fee": 6
            },
            "1900-5": {
              "monthlyPayment": 566.21,
              "amount": "1900",
              "term": "5",
              "fee": 6
            },
            "1900-6": {
              "monthlyPayment": 501.99,
              "amount": "1900",
              "term": "6",
              "fee": 6
            },
            "1900-7": {
              "monthlyPayment": 457.06,
              "amount": "1900",
              "term": "7",
              "fee": 6
            },
            "1900-8": {
              "monthlyPayment": 424.17,
              "amount": "1900",
              "term": "8",
              "fee": 6
            },
            "1900-9": {
              "monthlyPayment": 399.31,
              "amount": "1900",
              "term": "9",
              "fee": 6
            },
            "2000-2": {
              "monthlyPayment": 1225.66,
              "amount": "2000",
              "term": "2",
              "fee": 6
            },
            "2000-3": {
              "monthlyPayment": 873.5,
              "amount": "2000",
              "term": "3",
              "fee": 6
            },
            "2000-4": {
              "monthlyPayment": 699.18,
              "amount": "2000",
              "term": "4",
              "fee": 6
            },
            "2000-5": {
              "monthlyPayment": 596.01,
              "amount": "2000",
              "term": "5",
              "fee": 6
            },
            "2000-6": {
              "monthlyPayment": 528.41,
              "amount": "2000",
              "term": "6",
              "fee": 6
            },
            "2000-7": {
              "monthlyPayment": 481.12,
              "amount": "2000",
              "term": "7",
              "fee": 6
            },
            "2000-8": {
              "monthlyPayment": 446.5,
              "amount": "2000",
              "term": "8",
              "fee": 6
            },
            "2000-9": {
              "monthlyPayment": 420.32,
              "amount": "2000",
              "term": "9",
              "fee": 6
            },
            "2100-2": {
              "monthlyPayment": 1286.94,
              "amount": "2100",
              "term": "2",
              "fee": 6
            },
            "2100-3": {
              "monthlyPayment": 917.18,
              "amount": "2100",
              "term": "3",
              "fee": 6
            },
            "2100-4": {
              "monthlyPayment": 734.14,
              "amount": "2100",
              "term": "4",
              "fee": 6
            },
            "2100-5": {
              "monthlyPayment": 625.81,
              "amount": "2100",
              "term": "5",
              "fee": 6
            },
            "2100-6": {
              "monthlyPayment": 554.83,
              "amount": "2100",
              "term": "6",
              "fee": 6
            },
            "2100-7": {
              "monthlyPayment": 505.17,
              "amount": "2100",
              "term": "7",
              "fee": 6
            },
            "2100-8": {
              "monthlyPayment": 468.82,
              "amount": "2100",
              "term": "8",
              "fee": 6
            },
            "2100-9": {
              "monthlyPayment": 441.34,
              "amount": "2100",
              "term": "9",
              "fee": 6
            },
            "2200-2": {
              "monthlyPayment": 1348.23,
              "amount": "2200",
              "term": "2",
              "fee": 6
            },
            "2200-3": {
              "monthlyPayment": 960.86,
              "amount": "2200",
              "term": "3",
              "fee": 6
            },
            "2200-4": {
              "monthlyPayment": 769.1,
              "amount": "2200",
              "term": "4",
              "fee": 6
            },
            "2200-5": {
              "monthlyPayment": 655.61,
              "amount": "2200",
              "term": "5",
              "fee": 6
            },
            "2200-6": {
              "monthlyPayment": 581.25,
              "amount": "2200",
              "term": "6",
              "fee": 6
            },
            "2200-7": {
              "monthlyPayment": 529.23,
              "amount": "2200",
              "term": "7",
              "fee": 6
            },
            "2200-8": {
              "monthlyPayment": 491.15,
              "amount": "2200",
              "term": "8",
              "fee": 6
            },
            "2200-9": {
              "monthlyPayment": 462.35,
              "amount": "2200",
              "term": "9",
              "fee": 6
            },
            "2300-2": {
              "monthlyPayment": 1409.51,
              "amount": "2300",
              "term": "2",
              "fee": 6
            },
            "2300-3": {
              "monthlyPayment": 1004.53,
              "amount": "2300",
              "term": "3",
              "fee": 6
            },
            "2300-4": {
              "monthlyPayment": 804.06,
              "amount": "2300",
              "term": "4",
              "fee": 6
            },
            "2300-5": {
              "monthlyPayment": 685.41,
              "amount": "2300",
              "term": "5",
              "fee": 6
            },
            "2300-6": {
              "monthlyPayment": 607.67,
              "amount": "2300",
              "term": "6",
              "fee": 6
            },
            "2300-7": {
              "monthlyPayment": 553.28,
              "amount": "2300",
              "term": "7",
              "fee": 6
            },
            "2300-8": {
              "monthlyPayment": 513.47,
              "amount": "2300",
              "term": "8",
              "fee": 6
            },
            "2300-9": {
              "monthlyPayment": 483.37,
              "amount": "2300",
              "term": "9",
              "fee": 6
            },
            "2400-2": {
              "monthlyPayment": 1470.79,
              "amount": "2400",
              "term": "2",
              "fee": 6
            },
            "2400-3": {
              "monthlyPayment": 1048.21,
              "amount": "2400",
              "term": "3",
              "fee": 6
            },
            "2400-4": {
              "monthlyPayment": 839.01,
              "amount": "2400",
              "term": "4",
              "fee": 6
            },
            "2400-5": {
              "monthlyPayment": 715.21,
              "amount": "2400",
              "term": "5",
              "fee": 6
            },
            "2400-6": {
              "monthlyPayment": 634.09,
              "amount": "2400",
              "term": "6",
              "fee": 6
            },
            "2400-7": {
              "monthlyPayment": 577.34,
              "amount": "2400",
              "term": "7",
              "fee": 6
            },
            "2400-8": {
              "monthlyPayment": 535.8,
              "amount": "2400",
              "term": "8",
              "fee": 6
            },
            "2400-9": {
              "monthlyPayment": 504.39,
              "amount": "2400",
              "term": "9",
              "fee": 6
            },
            "2500-2": {
              "monthlyPayment": 1532.08,
              "amount": "2500",
              "term": "2",
              "fee": 6
            },
            "2500-3": {
              "monthlyPayment": 1091.88,
              "amount": "2500",
              "term": "3",
              "fee": 6
            },
            "2500-4": {
              "monthlyPayment": 873.97,
              "amount": "2500",
              "term": "4",
              "fee": 6
            },
            "2500-5": {
              "monthlyPayment": 745.02,
              "amount": "2500",
              "term": "5",
              "fee": 6
            },
            "2500-6": {
              "monthlyPayment": 660.51,
              "amount": "2500",
              "term": "6",
              "fee": 6
            },
            "2500-7": {
              "monthlyPayment": 601.4,
              "amount": "2500",
              "term": "7",
              "fee": 6
            },
            "2500-8": {
              "monthlyPayment": 558.12,
              "amount": "2500",
              "term": "8",
              "fee": 6
            },
            "2500-9": {
              "monthlyPayment": 525.4,
              "amount": "2500",
              "term": "9",
              "fee": 6
            },
            "2600-2": {
              "monthlyPayment": 1593.36,
              "amount": "2600",
              "term": "2",
              "fee": 6
            },
            "2600-3": {
              "monthlyPayment": 1135.55,
              "amount": "2600",
              "term": "3",
              "fee": 6
            },
            "2600-4": {
              "monthlyPayment": 908.93,
              "amount": "2600",
              "term": "4",
              "fee": 6
            },
            "2600-5": {
              "monthlyPayment": 774.82,
              "amount": "2600",
              "term": "5",
              "fee": 6
            },
            "2600-6": {
              "monthlyPayment": 686.93,
              "amount": "2600",
              "term": "6",
              "fee": 6
            },
            "2600-7": {
              "monthlyPayment": 625.45,
              "amount": "2600",
              "term": "7",
              "fee": 6
            },
            "2600-8": {
              "monthlyPayment": 580.45,
              "amount": "2600",
              "term": "8",
              "fee": 6
            },
            "2600-9": {
              "monthlyPayment": 546.42,
              "amount": "2600",
              "term": "9",
              "fee": 6
            },
            "2700-2": {
              "monthlyPayment": 1654.65,
              "amount": "2700",
              "term": "2",
              "fee": 6
            },
            "2700-3": {
              "monthlyPayment": 1179.23,
              "amount": "2700",
              "term": "3",
              "fee": 6
            },
            "2700-4": {
              "monthlyPayment": 943.89,
              "amount": "2700",
              "term": "4",
              "fee": 6
            },
            "2700-5": {
              "monthlyPayment": 804.62,
              "amount": "2700",
              "term": "5",
              "fee": 6
            },
            "2700-6": {
              "monthlyPayment": 713.35,
              "amount": "2700",
              "term": "6",
              "fee": 6
            },
            "2700-7": {
              "monthlyPayment": 649.51,
              "amount": "2700",
              "term": "7",
              "fee": 6
            },
            "2700-8": {
              "monthlyPayment": 602.77,
              "amount": "2700",
              "term": "8",
              "fee": 6
            },
            "2700-9": {
              "monthlyPayment": 567.44,
              "amount": "2700",
              "term": "9",
              "fee": 6
            },
            "2800-2": {
              "monthlyPayment": 1715.93,
              "amount": "2800",
              "term": "2",
              "fee": 6
            },
            "2800-3": {
              "monthlyPayment": 1222.91,
              "amount": "2800",
              "term": "3",
              "fee": 6
            },
            "2800-4": {
              "monthlyPayment": 978.85,
              "amount": "2800",
              "term": "4",
              "fee": 6
            },
            "2800-5": {
              "monthlyPayment": 834.42,
              "amount": "2800",
              "term": "5",
              "fee": 6
            },
            "2800-6": {
              "monthlyPayment": 739.77,
              "amount": "2800",
              "term": "6",
              "fee": 6
            },
            "2800-7": {
              "monthlyPayment": 673.56,
              "amount": "2800",
              "term": "7",
              "fee": 6
            },
            "2800-8": {
              "monthlyPayment": 625.1,
              "amount": "2800",
              "term": "8",
              "fee": 6
            },
            "2800-9": {
              "monthlyPayment": 588.45,
              "amount": "2800",
              "term": "9",
              "fee": 6
            },
            "2900-2": {
              "monthlyPayment": 1777.21,
              "amount": "2900",
              "term": "2",
              "fee": 6
            },
            "2900-3": {
              "monthlyPayment": 1266.59,
              "amount": "2900",
              "term": "3",
              "fee": 6
            },
            "2900-4": {
              "monthlyPayment": 1013.81,
              "amount": "2900",
              "term": "4",
              "fee": 6
            },
            "2900-5": {
              "monthlyPayment": 864.22,
              "amount": "2900",
              "term": "5",
              "fee": 6
            },
            "2900-6": {
              "monthlyPayment": 766.19,
              "amount": "2900",
              "term": "6",
              "fee": 6
            },
            "2900-7": {
              "monthlyPayment": 697.62,
              "amount": "2900",
              "term": "7",
              "fee": 6
            },
            "2900-8": {
              "monthlyPayment": 647.42,
              "amount": "2900",
              "term": "8",
              "fee": 6
            },
            "2900-9": {
              "monthlyPayment": 609.47,
              "amount": "2900",
              "term": "9",
              "fee": 6
            },
            "3000-2": {
              "monthlyPayment": 1838.49,
              "amount": "3000",
              "term": "2",
              "fee": 6
            },
            "3000-3": {
              "monthlyPayment": 1310.26,
              "amount": "3000",
              "term": "3",
              "fee": 6
            },
            "3000-4": {
              "monthlyPayment": 1048.77,
              "amount": "3000",
              "term": "4",
              "fee": 6
            },
            "3000-5": {
              "monthlyPayment": 894.02,
              "amount": "3000",
              "term": "5",
              "fee": 6
            },
            "3000-6": {
              "monthlyPayment": 792.61,
              "amount": "3000",
              "term": "6",
              "fee": 6
            },
            "3000-7": {
              "monthlyPayment": 721.67,
              "amount": "3000",
              "term": "7",
              "fee": 6
            },
            "3000-8": {
              "monthlyPayment": 669.75,
              "amount": "3000",
              "term": "8",
              "fee": 6
            },
            "3000-9": {
              "monthlyPayment": 630.48,
              "amount": "3000",
              "term": "9",
              "fee": 6
            }
          }
        }
      },

    });
  </script>

  <script src="./form.js"></script>

</body>

</html>