tiggomark.canvasController = (function () {

    var canvasName = '';

    var setCanvasName = function (name) {
        canvasName = name;
    };

    var initFilterBar = function () {

        jQuery(window).bind("load", function () {
            jQuery(".loading").fadeOut();
            jQuery(".filterBar .row-fluid").css("opacity", "1");


        });

    };


   var escrever =  async function (str, el) {
    str = str.trim();
      if (str.length == 0) {
        return;
      }

      const regexTagContent = /<([^>]+)>[^<]*<\/\1>/i;
      const regexTag = /<\/?([a-z][a-z0-9]*)\b[^>]*>/i;
      const tag = str.match(regexTag)[1];
      const content = str.match(regexTagContent)[0].replace(/<\/?\w+>/g, '');
      var element;
      if(tag == "p"){
      element= document.createElement("p");
      var span = document.createElement("span");
      span.setAttribute("class", "badge badge-default");
      span.setAttribute("style", "font-size:14px");
       var elementIcon = document.createElement("i");
         elementIcon.setAttribute("class", "fa fa-thumbtack");
         span.appendChild(elementIcon);
         span.innerHTML+= " ";
         element.appendChild(span);
         el.appendChild(element);
         element = span;
       }
       else {

       element = document.createElement(tag);
       el.appendChild(element);
       }


      var char = content.split('');

      for (const next of char) {
        element.innerHTML+= next;
        await new Promise((resolve) => setTimeout(resolve, 20));
      }

    }


    var initCanvasLinks = function () {


       jQuery(".showCanvasInsightsLink").click(function () {

             jQuery('#showCanvasInsights').modal('show');

         });


        jQuery(".addCanvasLink").click(function () {

            jQuery('#addCanvas').modal('show');

        });

        jQuery(".editCanvasLink").click(function () {

            jQuery('#editCanvas').modal('show');

        });

        jQuery(".cloneCanvasLink").click(function () {

            jQuery('#cloneCanvas').modal('show');

        });

        jQuery(".mergeCanvasLink").click(function () {

            jQuery('#mergeCanvas').modal('show');

        });

        jQuery(".importCanvasLink").click(function () {

            jQuery('#importCanvas').modal('show');

        });



          // Adiciona um ouvinte de eventos ao botão
        jQuery('#gerar-insights').click(async function() {
             // Define o token de API

             console.log("Clicou no gerar insights");

             var div = document.getElementById('canvasInsightContent');

             var texto = `<h1>Proposta de valor</h1>
                 <p>Melhoria na eficiência da gestão de leads e clientes.</p>
                 <p>Integração com ERPs para facilitar o processo de vendas e atendimento ao cliente.</p>
                 <p>Análise de dados para tomada de decisões informadas.</p>
                 <h1>Relacionamento com clientes</h1>
                 <p>Suporte técnico via chat, e-mail e telefone.</p>
                 <p>Comunidade online para compartilhamento de experiências e dicas.</p>
                 <p>Atendimento personalizado para clientes corporativos.</p>
                 <h1>Segmentos de clientes</h1>
                 <p>Pequenas e médias empresas que buscam soluções de CRM acessíveis e fáceis de usar.</p>
                 <p>Empresas que desejam integrar o gerenciamento de leads e clientes com seus sistemas ERP existentes.</p>
                 <h1>Alternativas existentes</h1>
                 <p>Plataformas de CRM concorrentes, como Salesforce e HubSpot.</p>
                 <p>Soluções de gerenciamento de leads e clientes desenvolvidas internamente.</p>
                 <h1>Métricas chave</h1>
                 <p>Número de novos leads e clientes adquiridos.</p>
                 <p>Taxa de conversão de leads em clientes.</p>
                 <p>Nível de satisfação do cliente.</p>
                 <p>Receita gerada por assinaturas e serviços adicionais.</p>
                 <h1>Conceito de alto nível</h1>
                 <p>Uma plataforma de CRM Web que ajuda as empresas a gerenciar seus leads e clientes de forma mais eficiente, integrando-se com ERPs para facilitar o processo de vendas e atendimento ao cliente.</p>
                 <h1>Canais</h1>
                 <p>Website e aplicativo móvel para dispositivos iOS e Android.</p>
                 <p>Marketing de conteúdo em blogs, redes sociais e fóruns relevantes.</p>
                 <p>Parcerias com fornecedores de software ERP para integrar a plataforma de CRM Web.</p>
                 <h1>Primeiros usuários</h1>
                 <p>Pequenas e médias empresas que buscam soluções de gerenciamento de vendas acessíveis e fáceis de usar.</p>
                 <p>Empresas que desejam integrar o gerenciamento de vendas com seus sistemas ERP existentes.</p>
                 <h1>Estrutura de custos</h1>
                 <p>Desenvolvimento e manutenção da plataforma.</p>
                 <p>Custos de suporte técnico e atendimento ao cliente.</p>
                 <p>Marketing e publicidade para promover a plataforma.</p>
                 <p>Despesas gerais, como aluguel, serviços públicos e suprimentos.</p>
                 <h1>Fontes de receita</h1>
                 <p>Assinaturas mensais para acesso à plataforma e recursos adicionais.</p>
                 <p>Pacotes de consultoria e treinamento para empresas que precisam de ajuda adicional.</p>
                 <p>Parcerias com outras empresas para oferecer serviços adicionais aos usuários.</p>`;


                 texto = texto.replace(/\n/g, "")


             const splitRegex = /(<[^>]*>.*?<\/[^>]*>)/ig;
             const partes = texto.split(splitRegex);

             console.log("Partes: ");
             console.log(partes);

              for (const texto of partes) {
               await escrever(texto, div);
             }

         });




    };

    var closeModal = false;

    //Variables
    var canvasoptions = {
        sizes: {
            minW:  700,
            minH: 1000,
        },
        resizable: true,
        autoSizable: true,
        callbacks: {
            beforeShowCont: function () {
                jQuery(".showDialogOnLoad").show();
                if (closeModal == true) {
                    closeModal = false;
                    location.reload();
                }
            },
            afterShowCont: function () {
                jQuery("." + canvasName + "CanvasModal, #commentForm, #commentForm .deleteComment, ." + canvasName + "CanvasMilestone .deleteMilestone").nyroModal(canvasoptions);

            },
            beforeClose: function () {
                location.reload();
            }
        },
        titleFromIframe: true

    };


    //Constructor
    (function () {
        jQuery(document).ready(
            function () {
                _initModals();
            }
        );

    })();

    //Functions

    var _initModals = function () {
        jQuery("." + canvasName + "CanvasModal, #commentForm, #commentForm .deleteComment, ." + canvasName + "CanvasMilestone .deleteMilestone").nyroModal(canvasoptions);
    };

    var openModalManually = function (url) {
        jQuery.nmManual(url, canvasoptions);
    };

    var toggleMilestoneSelectors = function (trigger) {
        if (trigger == 'existing') {
            jQuery('#newMilestone, #milestoneSelectors').hide('fast');
            jQuery('#existingMilestone').show();
            _initModals();
        }
        if (trigger == 'new') {
            jQuery('#newMilestone').show();
            jQuery('#existingMilestone, #milestoneSelectors').hide('fast');
            _initModals();
        }

        if (trigger == 'hide') {
            jQuery('#newMilestone, #existingMilestone').hide('fast');
            jQuery('#milestoneSelectors').show('fast');
        }
    };

    var setCloseModal = function () {
        closeModal = true;
    };

    var initUserDropdown = function () {

        jQuery("body").on(
            "click",
            ".userDropdown .dropdown-menu a",
            function () {

                var dataValue = jQuery(this).attr("data-value").split("_");
                var dataLabel = jQuery(this).attr('data-label');

                if (dataValue.length == 3) {
                    var canvasId = dataValue[0];
                    var userId = dataValue[1];
                    var profileImageId = dataValue[2];

                    jQuery.ajax(
                        {
                            type: 'PATCH',
                            url: tiggomark.appUrl + '/api/' + canvasName + 'canvas',
                            data:
                                {
                                    id : canvasId,
                                    author:userId
                            }
                        }
                    ).done(
                        function () {
                            jQuery("#userDropdownMenuLink" + canvasId + " span.text span#userImage" + canvasId + " img").attr("src", tiggomark.appUrl + "/api/users?profileImage=" + userId);
                            jQuery.growl({message: tiggomark.i18n.__("short_notifications.user_updated"), style: "success"});
                        }
                    );
                }
            }
        );
    };

    var initStatusDropdown = function () {

        jQuery("body").on(
            "click",
            ".statusDropdown .dropdown-menu a",
            function () {

                var dataValue = jQuery(this).attr("data-value").split("/");
                var dataLabel = jQuery(this).attr('data-label');

                if (dataValue.length == 2) {
                    var canvasItemId = dataValue[0];
                    var status = dataValue[1];
                    var statusClass = jQuery(this).attr('class');


                    jQuery.ajax(
                        {
                            type: 'PATCH',
                            url: tiggomark.appUrl + '/api/' + canvasName + 'canvas',
                            data:
                                {
                                    id : canvasItemId,
                                    status: status
                            }
                        }
                    ).done(
                        function () {
                            jQuery("#statusDropdownMenuLink" + canvasItemId + " span.text").text(dataLabel);
                            jQuery("#statusDropdownMenuLink" + canvasItemId).removeClass().addClass(statusClass + " dropdown-toggle f-left status ");
                            jQuery.growl({message: tiggomark.i18n.__("short_notifications.status_updated")});

                        }
                    );
                }
            }
        );

    };

    var initRelatesDropdown = function () {

        jQuery("body").on(
            "click",
            ".relatesDropdown .dropdown-menu a",
            function () {

                var dataValue = jQuery(this).attr("data-value").split("/");
                var dataLabel = jQuery(this).attr('data-label');

                if (dataValue.length == 2) {
                    var canvasItemId = dataValue[0];
                    var relates = dataValue[1];
                    var relatesClass = jQuery(this).attr('class');


                    jQuery.ajax(
                        {
                            type: 'PATCH',
                            url: tiggomark.appUrl + '/api/' + canvasName + 'canvas',
                            data:
                                {
                                    id : canvasItemId,
                                    relates: relates
                            }
                        }
                    ).done(
                        function () {
                            jQuery("#relatesDropdownMenuLink" + canvasItemId + " span.text").text(dataLabel);
                            jQuery("#relatesDropdownMenuLink" + canvasItemId).removeClass().addClass(relatesClass + " dropdown-toggle f-left relates ");
                            jQuery.growl({message: tiggomark.i18n.__("short_notifications.relates_updated")});

                        }
                    );
                }
            }
        );

    };

    // Make public what you want to have public, everything else is private
    return {
        setCanvasName:setCanvasName,
        initFilterBar:initFilterBar,
        initCanvasLinks:initCanvasLinks,
        initUserDropdown:initUserDropdown,
        initStatusDropdown:initStatusDropdown,
        initRelatesDropdown:initRelatesDropdown,
        setCloseModal:setCloseModal,
        toggleMilestoneSelectors:toggleMilestoneSelectors,
        openModalManually:openModalManually
    };

})();
