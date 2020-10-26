<section class="main" id="dados">
  <div>
    <h1>Dados</h1>
    <p>
      No contexto Brasil os dados disponibilizados pelo Instituto podem ser baixados por
      município (dados locais) ou ao nível nacional.
    </p>
    <h2>Fluxo geral e repositorios de dados</h2>
    <p>
      AddressForAll recebe dados doados por diversas fontes, tais como prefeituras, IBGE, e OpenStreetMap,
      que publicam ou transferem por licença aberta (CC0, ODbL ou outra) os dados que produzem.
    </p>
    <div style='text-align:center'><img src='resources/img/datafigs-flow1.svg'></div>
    <p>Os dados de preservacao sao de uso geral (diversos projetos), e, uma vez homologados, recebem tratamento e garantia de preservacao por pelo menos 20 anos.</p>
    <p>A seguranca e integridade dos dados preservados é garantida pelo <a href="http://api-test.addressforall.org/v1.htm/nav_eclusa/">sistema de Eclusa</a>,
      com integridade SHA256 a cada arquivo, confirmação publica e confirmação juridica (registro final na Fundacao Biblioteca Nacional).
      Em caso de arquivo obtido por download de site oficial, datacao e registro da URL de acesso é feita atraves da <a href="https://archive.org/" rel="external" target="_blank"><i>Wayback Machine</i></a>.
    </p>
    <h2>Dados a cada projeto</h2>
    <p>
      A Plataforma de Projetos do Instituto AddressForAll consome os dados preservados pelo <a href="http://git.AddressForAll.org/digital-preservation">Projeto Digital Preservation</a>.
      Cada projeto faz seu proprio recorte e filtragem de dados preservados.
    </p>
    <style>
      table.qtstatus td {text-align: center;}
      table.qtstatus td.smallLabel {text-align: left; font-size: 75%;}
      /*
      table.qtstatus tr.totFile td:not(.smallLabel) {font-weight:bold;}
      table.qtstatus tr td:nth-child(3) {text-align: center;}
      table.qtstatus tr td:nth-child(4) {text-align: right;} */
    </style>

    <div id="qtstatus_container" style="text-align:center; align:center"></div>

    <script type="text/javascript">
    // // // small LIBRARY:
    function jsTpl(strings, ...keys) {
        return (function(...values) {
          let dict = values[values.length - 1] || {};
          let result = [strings[0]];
          keys.forEach(function(key, i) {
            let value = Number.isInteger(key) ? values[key] : dict[key];
            result.push(value, strings[i + 1]);
          });
          return result.join('');
        });
      }
      // // // \small LIBRARY

      const qtstatus_container = document.getElementById('qtstatus_container')
      const preTpl_tr0 = jsTpl`
      <tr><td width="65"></td>
         <td width="30%"><a href="${'url1'}">${'desc1'}</a></td>
         <td width="30%"><a href="${'url2'}">${'desc2'}</a></td>
         <td width="30%"><a href="${'url3'}">${'desc3'}</a></td>
      </tr>`;
      const preTpl_tab = jsTpl`
      <table class="qtstatus" border="0" align="center">
        <caption style="caption-side:top;">Projeto ${'prjName'}, status atual</caption>
        ${'tr0'}
        <tr><td width="65"></td><td colspan="3"><img src='/resources/img/datafigs-flow2-tabPad.svg'></td></tr>
        <tr class="totFile"><td class="smallLabel">Qt. arquivos: </td>
          <td width="30%"><b>${'preserv_n'}</b></td>
          <td width="30%"><b>{{in_n}}</b></td>
          <td width="30%"><b>{{out_n}}</b></td>
        </tr>
        <tr class="totFile"><td class="smallLabel">Mega bytes: </td>
          <td><b>${'preserv_mb'}</b> zip</td>
          <td><b>{{in_mb}}</b></td>
          <td><b>{{out_mb}}</b></td>
        </tr>
      </table>
      <p></p>`;

      const api_url1 = 'http://api-test.addressforall.org/_sql/origin_agg1'
      // falta query origin_agg1 filtrar recorte do AddressForAll, que tem origem no BR-in!
      fetch( api_url1 )
        .then( body => body.json() )
        .then( data => {
            if (Array.isArray(data)) { for(const res of data) if (typeof res == 'object') {
                url_ref = 'http://git.AddressForAll.org'
                let tr0 = preTpl_tr0({
                  url1:`${url_ref}/digital-preservation-${res.country}`, desc1:`dig. preserv. ${res.country}`,
                  url2:`${url_ref}/in-${res.country}`,  desc2:`in-${res.country}`,
                  url3:`${url_ref}/out-${res.country}`, desc3:`out-${res.country}`
                });
                let html_table = preTpl_tab({
                  prjName:    'AddressForAll '+res.country,
                  tr0:        tr0,
                  preserv_n:  res.orig_n_files,
                  preserv_mb: res.orig_mb
                });
                qtstatus_container.insertAdjacentHTML('beforeend', html_table);
              } else alert("error 2 on fetch "+api_url1)
            } else alert("error 1 on fetch "+api_url1)
        });
        // OSM.CODES? const api_url1 = 'http://api-test.addressforall.org/_sql/origin_agg1' ?
        // geral é https://github.com/datasets/country-codes BR é  datasets.ok.br.
    </script>

    <!-- #### -->
    <h1>Dados do Projeto AddressForAll</h1>
    Ciclo de processamento nos dados relativos a pontos de endereco, reunidos e consolidados pelo projeto.

    <div class="container">


      <div class="timeline-item" step='Passo 1'>
        <h1>Verificação</h1>
        <p>
          AddressForAll ao receber dados, começa por verificar a licença destes dados (procura-se dados com licença aberta (CC0) ou CCBYSA ou Odbl.
        </p>
        <p>AddressForAll pode ainda receber dados privados que poderão ser utilizados para alguns serviços providos pelo Instituto de maneira anonima.</p>
        <div class='dados-passo passo1'><img src='resources/img/passo1.1.png'><img src='resources/img/passo1.2.png'></div>
      </div>

      <div class="timeline-item" step='Passo 2'>
        <h1>Integridade</h1>
        <p>AddressForAll garante a integridade destes dados, armazenando eles de maneira segura por um prazo de 30 anos
        </p>
        <div class='dados-passo passo2'><img src='resources/img/passo2.png'></div>
      </div>

      <div class="timeline-item" step='Passo 3'>
        <h1>Tratamento</h1>
        <p>
          AddressForAll trata os dados limpando e organizando-os
        </p>
        <div class='dados-passo passo3'><img src='resources/img/passo3.1.png'><img src='resources/img/passo3.2.png'></div>
      </div>

      <div class="timeline-item" step='Passo 4'>
        <h1>Normalização</h1>
        <p>
          AddressForAll extrai da combinação dos dados um dado "otimizado" utilizado pelo AddressForAll para prover serviços otimizados através de API. Por exemplo a API de Geolocalização que retorna uma latitude / Longitude quando lhe é submetido um endereço postal.
        </p>
        <div class='dados-passo passo4'><img src='resources/img/passo4.png'></div>
      </div>

    </div>

  </div>
  <div class='buttons-dados'>
    <button>Dados locais</button>
    <button>Dados nacionais</button>
  </div>
</section>
