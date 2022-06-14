<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DigitalCertAPI</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/monokai-sublime.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
    <script>
        hljs.configure({
            tabReplace: '    ',
        });
        hljs.initHighlightingOnLoad();
    </script>
    <style>body {
    position: relative;
}

h1 {
    margin-top: 5px;
}

h1, h2, h3, h4 {
    color: #2b2b2b;
}

h2:after {
    content: ' ';
}

h5 {
    font-weight: bold;
}

h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {
    display: none;
    position: absolute;
    margin-left: 8px;
}

h1:hover a, h2:hover a, h3:hover a, h4:hover a, h5:hover a, h6:hover a {
    color: #a5a5a5;
    display: initial;
}

.nav.nav-tabs > li > a {
    padding-top: 4px;
    padding-bottom: 4px;
}

.tab-content {
    padding-top: 8px;
}

.table {
    margin-bottom: 8px;
}

pre {
    border-radius: 0px;
    border: none;
}

pre code {
    margin: -9.5px;
}

.request {
    margin-top: 12px;
    margin-bottom: 24px;
}

.response-text-sample {
    padding: 0px !important;
}

.response-text-sample pre {
    margin-bottom: 0px;
}


#sidebar-wrapper {
    z-index: 1000;
    position: fixed;
    left: 250px;
    width: 250px;
    height: 100%;
    margin-left: -250px;
    overflow-y: auto;
    overflow-x: hidden;
    background: #2b2b2b;
    padding-top: 20px;
}

#sidebar-wrapper ul {
    width: 250px;
}

#sidebar-wrapper ul li {
    margin-right: 10px;
}

#sidebar-wrapper ul li a:hover {
    background: inherit;
    text-decoration: none;
}

#sidebar-wrapper ul li a {
    display: block;
    color: #ECF0F1;
    padding: 6px 15px;
}

#sidebar-wrapper ul li ul {
    padding-left: 25px;
}

#sidebar-wrapper ul li ul li a {
    padding: 1px 0px;
}

#sidebar-wrapper ul li a:hover,
#sidebar-wrapper ul li a:focus {
    color: #e0c46c;
    border-right: solid 1px #e0c46c;
}

#sidebar-wrapper ul li.active > a {
    color: #e0c46c;
    border-right: solid 3px #e0c46c;
}

#sidebar-wrapper ul li:not(.active) ul {
    display: none;
}

#page-content-wrapper {
    width: 100%;
    position: absolute;
    padding: 15px 15px 15px 250px;
}
</style>
</head>
<body data-spy="scroll" data-target=".scrollspy">
<div id="sidebar-wrapper">
    <div class="scrollspy">
    <ul id="main-menu" data-spy="affix" class="nav">
        <li>
            <a href="#doc-general-notes">General notes</a>
        </li>

        <li>
            <a href="#doc-api-detail">API detail</a>
        </li>

        <li>
            <a href="#request-ping">ping</a>
        </li>

        <li>
            <a href="#request-getnode">getNode</a>
        </li>



        <li>
            <a href="#folder-certificate">Certificate</a>
            <ul>

                <li>
                    <a href="#request-certificate-getcertificate">getCertificate</a>
                </li>

                <li>
                    <a href="#request-certificate-createcertificate">createCertificate</a>
                </li>

                <li>
                    <a href="#request-certificate-revokecertificate">revokeCertificate</a>
                </li>

                <li>
                    <a href="#request-certificate-getcontract">getContract</a>
                </li>

            </ul>
        </li>


        <li>
            <a href="#folder-certifier">Certifier</a>
            <ul>

                <li>
                    <a href="#request-certifier-isaccredited">isAccredited</a>
                </li>

                <li>
                    <a href="#request-certifier-getinstitutionofcertifier">getInstitutionOfCertifier</a>
                </li>

                <li>
                    <a href="#request-certifier-createcertifier">createCertifier</a>
                </li>

                <li>
                    <a href="#request-certifier-removecertifier">removeCertifier</a>
                </li>

                <li>
                    <a href="#request-certifier-getcontract">getContract</a>
                </li>

            </ul>
        </li>

    </ul>
</div>

</div>
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1>DigitalCertAPI</h1>

                <h2 id="doc-general-notes">
                    General notes
                    <a href="#doc-general-notes"><i class="glyphicon glyphicon-link"></i></a>
                </h2>

                <p>An API for the ilddigitalcert Moodle Plugin to communicate with the blockchain nodes.</p>




                <h2 id="doc-api-detail">
                    API detail
                    <a href="#doc-api-detail"><i class="glyphicon glyphicon-link"></i></a>
                </h2>



                <div class="request">

                    <h3 id="request-ping">
                        ping
                        <a href="#request-ping"><i class="glyphicon glyphicon-link"></i></a>
                    </h3>

                    <div><p>Returns 200 OK if the API Server is alive and well.</p>
</div>

                    <div>
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#request-ping-example-curl" data-toggle="tab">Curl</a></li>
                            <li role="presentation"><a href="#request-ping-example-http" data-toggle="tab">HTTP</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="request-ping-example-curl">
                                <pre><code class="hljs curl">curl -X GET "https://dev-isy.th-luebeck.de/digitalcertapi/ping"</code></pre>
                            </div>
                            <div class="tab-pane" id="request-ping-example-http">
                                <pre><code class="hljs http">GET /digitalcertapi/ping HTTP/1.1
Host: dev-isy.th-luebeck.de</code></pre>
                            </div>
                        </div>
                    </div>


                    <div>
                        <ul class="nav nav-tabs" role="tablist">

                            <li role="presentation" class="active">
                                <a href="#request-ping-responses-4f6eaf87-6e0d-456a-804f-c2773d271489" data-toggle="tab">

                                    Server is alive and well

                                </a>
                            </li>

                            <li role="presentation">
                                <a href="#request-ping-responses-c9221b93-f1b8-4c7b-ba0b-a59e90b426dd" data-toggle="tab">

                                    Server is down

                                </a>
                            </li>

                        </ul>
                        <div class="tab-content">

                            <div class="tab-pane active" id="request-ping-responses-4f6eaf87-6e0d-456a-804f-c2773d271489">
                                <table class="table table-bordered">
                                    <tr><th style="width: 20%;">Status</th><td>204 No Content</td></tr>

                                    <tr><th style="width: 20%;">Content-Type</th><td>text/plain</td></tr>


                                </table>
                            </div>

                            <div class="tab-pane" id="request-ping-responses-c9221b93-f1b8-4c7b-ba0b-a59e90b426dd">
                                <table class="table table-bordered">
                                    <tr><th style="width: 20%;">Status</th><td>500 Internal Server Error</td></tr>

                                    <tr><th style="width: 20%;">Content-Type</th><td>text/plain</td></tr>


                                </table>
                            </div>

                        </div>
                    </div>


                    <hr>
                </div>


                <div class="request">

                    <h3 id="request-getnode">
                        getNode
                        <a href="#request-getnode"><i class="glyphicon glyphicon-link"></i></a>
                    </h3>

                    <div></div>

                    <div>
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#request-getnode-example-curl" data-toggle="tab">Curl</a></li>
                            <li role="presentation"><a href="#request-getnode-example-http" data-toggle="tab">HTTP</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="request-getnode-example-curl">
                                <pre><code class="hljs curl">curl -X GET "https://dev-isy.th-luebeck.de/digitalcertapi/node"</code></pre>
                            </div>
                            <div class="tab-pane" id="request-getnode-example-http">
                                <pre><code class="hljs http">GET /digitalcertapi/node HTTP/1.1
Host: dev-isy.th-luebeck.de</code></pre>
                            </div>
                        </div>
                    </div>


                    <div>
                        <ul class="nav nav-tabs" role="tablist">

                            <li role="presentation" class="active">
                                <a href="#request-getnode-responses-204d505d-b957-4968-82a1-42181d247697" data-toggle="tab">

                                    Response

                                </a>
                            </li>

                        </ul>
                        <div class="tab-content">

                            <div class="tab-pane active" id="request-getnode-responses-204d505d-b957-4968-82a1-42181d247697">
                                <table class="table table-bordered">
                                    <tr><th style="width: 20%;">Status</th><td>200 OK</td></tr>

                                    <tr><th style="width: 20%;">Date</th><td>Fri, 27 May 2022 11:16:55 GMT</td></tr>

                                    <tr><th style="width: 20%;">Server</th><td>Apache</td></tr>

                                    <tr><th style="width: 20%;">X-Powered-By</th><td>PHP/7.4.29</td></tr>

                                    <tr><th style="width: 20%;">Cache-Control</th><td>no-cache, private</td></tr>

                                    <tr><th style="width: 20%;">Strict-Transport-Security</th><td>max-age=15768000</td></tr>

                                    <tr><th style="width: 20%;">Upgrade</th><td>h2,h2c</td></tr>

                                    <tr><th style="width: 20%;">Connection</th><td>Upgrade, Keep-Alive</td></tr>

                                    <tr><th style="width: 20%;">Keep-Alive</th><td>timeout=5, max=100</td></tr>

                                    <tr><th style="width: 20%;">Transfer-Encoding</th><td>chunked</td></tr>

                                    <tr><th style="width: 20%;">Content-Type</th><td>application/json</td></tr>



                                    <tr><td class="response-text-sample" colspan="2">
                                        <pre><code>{
    "url": "http://quorum.th-luebeck.de:8545"
}</code></pre>
                                    </td></tr>


                                </table>
                            </div>

                        </div>
                    </div>


                    <hr>
                </div>





                <div class="endpoints-group">
                    <h3 id="folder-certificate">
                        Certificate
                        <a href="#folder-certificate"><i class="glyphicon glyphicon-link"></i></a>
                    </h3>

                    <div><p>Endpoints to get, create and revoke certificates.</p>
</div>



                    <div class="request">

                        <h4 id="request-certificate-getcertificate">
                            getCertificate
                            <a href="#request-certificate-getcertificate"><i class="glyphicon glyphicon-link"></i></a>
                        </h4>

                        <div><p>Retrieves the information stored in the blockchain for a certificate identified by its hash value.</p>
</div>

                        <div>
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#request-certificate-getcertificate-example-curl" data-toggle="tab">Curl</a></li>
                                <li role="presentation"><a href="#request-certificate-getcertificate-example-http" data-toggle="tab">HTTP</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="request-certificate-getcertificate-example-curl">
                                    <pre><code class="hljs curl">curl -X GET "https://dev-isy.th-luebeck.de/digitalcertapi/certificate/0x5fd451fccac33e6c743fa07f2b8427a970c8fa6bd645761c062e53bb875c8cf1"</code></pre>
                                </div>
                                <div class="tab-pane" id="request-certificate-getcertificate-example-http">
                                    <pre><code class="hljs http">GET /digitalcertapi/certificate/0x5fd451fccac33e6c743fa07f2b8427a970c8fa6bd645761c062e53bb875c8cf1 HTTP/1.1
Host: dev-isy.th-luebeck.de</code></pre>
                                </div>
                            </div>
                        </div>


                        <div>
                            <ul class="nav nav-tabs" role="tablist">

                                <li role="presentation" class="active">
                                    <a href="#request-certificate-getcertificate-responses-67a148fd-7118-4d96-a0e3-d3fcdc3e781e" data-toggle="tab">

                                            Valid certificate

                                    </a>
                                </li>

                                <li role="presentation">
                                    <a href="#request-certificate-getcertificate-responses-8b55e6ee-06b8-4455-91e7-71e2b10ca5d6" data-toggle="tab">

                                            Invalid/revoked/expired certificate

                                    </a>
                                </li>

                                <li role="presentation">
                                    <a href="#request-certificate-getcertificate-responses-51952393-4e9b-4101-9b6a-b47a0b4a4783" data-toggle="tab">

                                            Nonexistent certificate

                                    </a>
                                </li>

                            </ul>
                            <div class="tab-content">

                                <div class="tab-pane active" id="request-certificate-getcertificate-responses-67a148fd-7118-4d96-a0e3-d3fcdc3e781e">
                                    <table class="table table-bordered">
                                        <tr><th style="width: 20%;">Status</th><td>200 OK</td></tr>

                                        <tr><th style="width: 20%;">Date</th><td>Tue, 31 May 2022 06:38:28 GMT</td></tr>

                                        <tr><th style="width: 20%;">Server</th><td>Apache</td></tr>

                                        <tr><th style="width: 20%;">X-Powered-By</th><td>PHP/7.4.29</td></tr>

                                        <tr><th style="width: 20%;">Cache-Control</th><td>no-cache, private</td></tr>

                                        <tr><th style="width: 20%;">Strict-Transport-Security</th><td>max-age=15768000</td></tr>

                                        <tr><th style="width: 20%;">Upgrade</th><td>h2,h2c</td></tr>

                                        <tr><th style="width: 20%;">Connection</th><td>Upgrade, Keep-Alive</td></tr>

                                        <tr><th style="width: 20%;">Keep-Alive</th><td>timeout=5, max=100</td></tr>

                                        <tr><th style="width: 20%;">Transfer-Encoding</th><td>chunked</td></tr>

                                        <tr><th style="width: 20%;">Content-Type</th><td>application/json</td></tr>



                                            <tr><td class="response-text-sample" colspan="2">
                                                <pre><code>{
    "institution": "0xd35d4a6e321d7af0d8502f9b695f25dc75ce47db",
    "institutionProfile": "0xc8894df0acd615bea1e063b28819259702b64177231eb263b1ea7662cc41c460",
    "startingDate": {},
    "endingDate": {},
    "onHold": {},
    "valid": true
}</code></pre>
                                            </td></tr>


                                    </table>
                                </div>

                                <div class="tab-pane" id="request-certificate-getcertificate-responses-8b55e6ee-06b8-4455-91e7-71e2b10ca5d6">
                                    <table class="table table-bordered">
                                        <tr><th style="width: 20%;">Status</th><td>200 OK</td></tr>

                                        <tr><th style="width: 20%;">Date</th><td>Tue, 31 May 2022 06:41:49 GMT</td></tr>

                                        <tr><th style="width: 20%;">Server</th><td>Apache</td></tr>

                                        <tr><th style="width: 20%;">X-Powered-By</th><td>PHP/7.4.29</td></tr>

                                        <tr><th style="width: 20%;">Cache-Control</th><td>no-cache, private</td></tr>

                                        <tr><th style="width: 20%;">Strict-Transport-Security</th><td>max-age=15768000</td></tr>

                                        <tr><th style="width: 20%;">Upgrade</th><td>h2,h2c</td></tr>

                                        <tr><th style="width: 20%;">Connection</th><td>Upgrade, Keep-Alive</td></tr>

                                        <tr><th style="width: 20%;">Keep-Alive</th><td>timeout=5, max=100</td></tr>

                                        <tr><th style="width: 20%;">Transfer-Encoding</th><td>chunked</td></tr>

                                        <tr><th style="width: 20%;">Content-Type</th><td>application/json</td></tr>



                                            <tr><td class="response-text-sample" colspan="2">
                                                <pre><code>{
    "institution": "0xd35d4a6e321d7af0d8502f9b695f25dc75ce47db",
    "institutionProfile": "0xc8894df0acd615bea1e063b28819259702b64177231eb263b1ea7662cc41c460",
    "startingDate": {},
    "endingDate": {},
    "onHold": {},
    "valid": false
}</code></pre>
                                            </td></tr>


                                    </table>
                                </div>

                                <div class="tab-pane" id="request-certificate-getcertificate-responses-51952393-4e9b-4101-9b6a-b47a0b4a4783">
                                    <table class="table table-bordered">
                                        <tr><th style="width: 20%;">Status</th><td>404 Not Found</td></tr>

                                        <tr><th style="width: 20%;">Date</th><td>Tue, 31 May 2022 06:43:07 GMT</td></tr>

                                        <tr><th style="width: 20%;">Server</th><td>Apache</td></tr>

                                        <tr><th style="width: 20%;">X-Powered-By</th><td>PHP/7.4.29</td></tr>

                                        <tr><th style="width: 20%;">Cache-Control</th><td>no-cache, private</td></tr>

                                        <tr><th style="width: 20%;">Strict-Transport-Security</th><td>max-age=15768000</td></tr>

                                        <tr><th style="width: 20%;">Upgrade</th><td>h2,h2c</td></tr>

                                        <tr><th style="width: 20%;">Connection</th><td>Upgrade, Keep-Alive</td></tr>

                                        <tr><th style="width: 20%;">Keep-Alive</th><td>timeout=5, max=100</td></tr>

                                        <tr><th style="width: 20%;">Transfer-Encoding</th><td>chunked</td></tr>

                                        <tr><th style="width: 20%;">Content-Type</th><td>application/json</td></tr>



                                            <tr><td class="response-text-sample" colspan="2">
                                                <pre><code>{
    "institution": "0x0000000000000000000000000000000000000000",
    "institutionProfile": "0",
    "startingDate": {},
    "endingDate": {},
    "onHold": {},
    "valid": false
}</code></pre>
                                            </td></tr>


                                    </table>
                                </div>

                            </div>
                        </div>


                        <hr>
                    </div>


                    <div class="request">

                        <h4 id="request-certificate-createcertificate">
                            createCertificate
                            <a href="#request-certificate-createcertificate"><i class="glyphicon glyphicon-link"></i></a>
                        </h4>

                        <div><p>Writes the hash of a certificate to the blockchain. This transaction needs to be signed with a private key. The startdate and enddate properties define the start and end of the certificates validity.</p>
</div>

                        <div>
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#request-certificate-createcertificate-example-curl" data-toggle="tab">Curl</a></li>
                                <li role="presentation"><a href="#request-certificate-createcertificate-example-http" data-toggle="tab">HTTP</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="request-certificate-createcertificate-example-curl">
                                    <pre><code class="hljs curl">curl -X POST -d '{
    "hash": "0x5fd451fccac33e6c743fa07f2b8427a970c8fa6bd645761c062e53bb875c8cf1",
    "pk": "PRIVATEKEY!123",
    "startdate": 1649948656,
    "enddate": 9999999999
}' "https://dev-isy.th-luebeck.de/digitalcertapi/certificate"</code></pre>
                                </div>
                                <div class="tab-pane" id="request-certificate-createcertificate-example-http">
                                    <pre><code class="hljs http">POST /digitalcertapi/certificate HTTP/1.1
Host: dev-isy.th-luebeck.de

{
    "hash": "0x5fd451fccac33e6c743fa07f2b8427a970c8fa6bd645761c062e53bb875c8cf1",
    "pk": "PRIVATEKEY!123",
    "startdate": 1649948656,
    "enddate": 9999999999
}</code></pre>
                                </div>
                            </div>
                        </div>



                        <hr>
                    </div>


                    <div class="request">

                        <h4 id="request-certificate-revokecertificate">
                            revokeCertificate
                            <a href="#request-certificate-revokecertificate"><i class="glyphicon glyphicon-link"></i></a>
                        </h4>

                        <div><p>Revokes a certificate identified by its hash value. This transaction needs to be signed with a private key.</p>
</div>

                        <div>
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#request-certificate-revokecertificate-example-curl" data-toggle="tab">Curl</a></li>
                                <li role="presentation"><a href="#request-certificate-revokecertificate-example-http" data-toggle="tab">HTTP</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="request-certificate-revokecertificate-example-curl">
                                    <pre><code class="hljs curl">curl -X DELETE -d '{
    "pk": "PRIVATEKEY!123"
}' "https://dev-isy.th-luebeck.de/digitalcertapi/certificate/0x5fd451fccac33e6c743fa07f2b8427a970c8fa6bd645761c062e53bb875c8cf1"</code></pre>
                                </div>
                                <div class="tab-pane" id="request-certificate-revokecertificate-example-http">
                                    <pre><code class="hljs http">DELETE /digitalcertapi/certificate/0x5fd451fccac33e6c743fa07f2b8427a970c8fa6bd645761c062e53bb875c8cf1 HTTP/1.1
Host: dev-isy.th-luebeck.de

{
    "pk": "PRIVATEKEY!123"
}</code></pre>
                                </div>
                            </div>
                        </div>



                        <hr>
                    </div>


                    <div class="request">

                        <h4 id="request-certificate-getcontract">
                            getContract
                            <a href="#request-certificate-getcontract"><i class="glyphicon glyphicon-link"></i></a>
                        </h4>

                        <div><p>Retrieves the information stored in the blockchain for a certificate identified by its hash value.</p>
</div>

                        <div>
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#request-certificate-getcontract-example-curl" data-toggle="tab">Curl</a></li>
                                <li role="presentation"><a href="#request-certificate-getcontract-example-http" data-toggle="tab">HTTP</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="request-certificate-getcontract-example-curl">
                                    <pre><code class="hljs curl">curl -X GET "https://dev-isy.th-luebeck.de/digitalcertapi/certificate/contract"</code></pre>
                                </div>
                                <div class="tab-pane" id="request-certificate-getcontract-example-http">
                                    <pre><code class="hljs http">GET /digitalcertapi/certificate/contract HTTP/1.1
Host: dev-isy.th-luebeck.de</code></pre>
                                </div>
                            </div>
                        </div>


                        <div>
                            <ul class="nav nav-tabs" role="tablist">

                                <li role="presentation" class="active">
                                    <a href="#request-certificate-getcontract-responses-177c41c2-34ac-4631-bab2-5221edeaae78" data-toggle="tab">

                                            Response

                                    </a>
                                </li>

                            </ul>
                            <div class="tab-content">

                                <div class="tab-pane active" id="request-certificate-getcontract-responses-177c41c2-34ac-4631-bab2-5221edeaae78">
                                    <table class="table table-bordered">
                                        <tr><th style="width: 20%;">Status</th><td>200 OK</td></tr>

                                        <tr><th style="width: 20%;">Date</th><td>Fri, 27 May 2022 10:06:28 GMT</td></tr>

                                        <tr><th style="width: 20%;">Server</th><td>Apache</td></tr>

                                        <tr><th style="width: 20%;">X-Powered-By</th><td>PHP/7.4.29</td></tr>

                                        <tr><th style="width: 20%;">Cache-Control</th><td>no-cache, private</td></tr>

                                        <tr><th style="width: 20%;">Strict-Transport-Security</th><td>max-age=15768000</td></tr>

                                        <tr><th style="width: 20%;">Upgrade</th><td>h2,h2c</td></tr>

                                        <tr><th style="width: 20%;">Connection</th><td>Upgrade, Keep-Alive</td></tr>

                                        <tr><th style="width: 20%;">Keep-Alive</th><td>timeout=5, max=100</td></tr>

                                        <tr><th style="width: 20%;">Transfer-Encoding</th><td>chunked</td></tr>

                                        <tr><th style="width: 20%;">Content-Type</th><td>application/json</td></tr>



                                            <tr><td class="response-text-sample" colspan="2">
                                                <pre><code>{
    "contract_name": "CertificateManagement",
    "contract_address": "0x83351591391e960924f10Fa49C078dad63CEd6C0",
    "contract_abi": [
        {
            "constant": true,
            "inputs": [],
            "name": "isActive",
            "outputs": [
                {
                    "name": "",
                    "type": "bool"
                }
            ],
            "payable": false,
            "stateMutability": "view",
            "type": "function"
        },
        {
            "constant": false,
            "inputs": [
                {
                    "name": "certificateHash",
                    "type": "bytes32"
                },
                {
                    "name": "newInstitution",
                    "type": "address"
                }
            ],
            "name": "transferCertificate",
            "outputs": [],
            "payable": false,
            "stateMutability": "nonpayable",
            "type": "function"
        },
        {
            "constant": true,
            "inputs": [
                {
                    "name": "certificateHash",
                    "type": "bytes32"
                }
            ],
            "name": "isValid",
            "outputs": [
                {
                    "name": "",
                    "type": "bool"
                }
            ],
            "payable": false,
            "stateMutability": "view",
            "type": "function"
        },
        {
            "constant": false,
            "inputs": [],
            "name": "renounceOwnership",
            "outputs": [],
            "payable": false,
            "stateMutability": "nonpayable",
            "type": "function"
        },
        {
            "constant": true,
            "inputs": [],
            "name": "owner",
            "outputs": [
                {
                    "name": "",
                    "type": "address"
                }
            ],
            "payable": false,
            "stateMutability": "view",
            "type": "function"
        },
        {
            "constant": true,
            "inputs": [],
            "name": "isOwner",
            "outputs": [
                {
                    "name": "",
                    "type": "bool"
                }
            ],
            "payable": false,
            "stateMutability": "view",
            "type": "function"
        },
        {
            "constant": false,
            "inputs": [],
            "name": "retire",
            "outputs": [],
            "payable": false,
            "stateMutability": "nonpayable",
            "type": "function"
        },
        {
            "constant": false,
            "inputs": [
                {
                    "name": "certificateHash",
                    "type": "bytes32"
                }
            ],
            "name": "revokeCertificate",
            "outputs": [],
            "payable": false,
            "stateMutability": "nonpayable",
            "type": "function"
        },
        {
            "constant": false,
            "inputs": [
                {
                    "name": "certificateHash",
                    "type": "bytes32"
                },
                {
                    "name": "startingDate",
                    "type": "uint256"
                },
                {
                    "name": "endingDate",
                    "type": "uint256"
                }
            ],
            "name": "storeCertificate",
            "outputs": [],
            "payable": false,
            "stateMutability": "nonpayable",
            "type": "function"
        },
        {
            "constant": false,
            "inputs": [
                {
                    "name": "im",
                    "type": "address"
                }
            ],
            "name": "updateIdentityManagement",
            "outputs": [],
            "payable": false,
            "stateMutability": "nonpayable",
            "type": "function"
        },
        {
            "constant": false,
            "inputs": [
                {
                    "name": "newOwner",
                    "type": "address"
                }
            ],
            "name": "transferOwnership",
            "outputs": [],
            "payable": false,
            "stateMutability": "nonpayable",
            "type": "function"
        },
        {
            "constant": true,
            "inputs": [
                {
                    "name": "certificateHash",
                    "type": "bytes32"
                }
            ],
            "name": "getCertificate",
            "outputs": [
                {
                    "name": "",
                    "type": "address"
                },
                {
                    "name": "",
                    "type": "bytes32"
                },
                {
                    "name": "",
                    "type": "address"
                },
                {
                    "name": "",
                    "type": "bytes32"
                },
                {
                    "name": "",
                    "type": "uint256[2]"
                },
                {
                    "name": "",
                    "type": "uint256"
                },
                {
                    "name": "",
                    "type": "bool"
                }
            ],
            "payable": false,
            "stateMutability": "view",
            "type": "function"
        },
        {
            "constant": false,
            "inputs": [
                {
                    "name": "certificateHash",
                    "type": "bytes32"
                }
            ],
            "name": "reactivateCertificate",
            "outputs": [],
            "payable": false,
            "stateMutability": "nonpayable",
            "type": "function"
        },
        {
            "inputs": [
                {
                    "name": "es",
                    "type": "address"
                },
                {
                    "name": "im",
                    "type": "address"
                }
            ],
            "payable": false,
            "stateMutability": "nonpayable",
            "type": "constructor"
        },
        {
            "anonymous": false,
            "inputs": [
                {
                    "indexed": true,
                    "name": "certifier",
                    "type": "address"
                },
                {
                    "indexed": true,
                    "name": "institution",
                    "type": "address"
                },
                {
                    "indexed": false,
                    "name": "certificate",
                    "type": "bytes32"
                },
                {
                    "indexed": false,
                    "name": "startingDate",
                    "type": "uint256"
                },
                {
                    "indexed": false,
                    "name": "endingDate",
                    "type": "uint256"
                }
            ],
            "name": "CertificateStored",
            "type": "event"
        },
        {
            "anonymous": false,
            "inputs": [
                {
                    "indexed": true,
                    "name": "certifier",
                    "type": "address"
                },
                {
                    "indexed": true,
                    "name": "institution",
                    "type": "address"
                },
                {
                    "indexed": false,
                    "name": "certificate",
                    "type": "bytes32"
                },
                {
                    "indexed": false,
                    "name": "revocationDate",
                    "type": "uint256"
                }
            ],
            "name": "CertificateRevoked",
            "type": "event"
        },
        {
            "anonymous": false,
            "inputs": [
                {
                    "indexed": true,
                    "name": "certifier",
                    "type": "address"
                },
                {
                    "indexed": true,
                    "name": "institution",
                    "type": "address"
                },
                {
                    "indexed": false,
                    "name": "certificate",
                    "type": "bytes32"
                }
            ],
            "name": "CertificateReactivated",
            "type": "event"
        },
        {
            "anonymous": false,
            "inputs": [
                {
                    "indexed": true,
                    "name": "certifier",
                    "type": "address"
                },
                {
                    "indexed": true,
                    "name": "institution",
                    "type": "address"
                },
                {
                    "indexed": false,
                    "name": "certificate",
                    "type": "bytes32"
                },
                {
                    "indexed": false,
                    "name": "receivingInstitution",
                    "type": "address"
                }
            ],
            "name": "CertificateTransferred",
            "type": "event"
        },
        {
            "anonymous": false,
            "inputs": [
                {
                    "indexed": false,
                    "name": "subject",
                    "type": "address"
                },
                {
                    "indexed": false,
                    "name": "object",
                    "type": "address"
                }
            ],
            "name": "Retired",
            "type": "event"
        },
        {
            "anonymous": false,
            "inputs": [
                {
                    "indexed": true,
                    "name": "previousOwner",
                    "type": "address"
                },
                {
                    "indexed": true,
                    "name": "newOwner",
                    "type": "address"
                }
            ],
            "name": "OwnershipTransferred",
            "type": "event"
        }
    ],
    "transaction_hash": "0xb5a602b8c12e5d2130d559e24be893fb93387e42cd6d63a147a5ce81dd9b7049"
}</code></pre>
                                            </td></tr>


                                    </table>
                                </div>

                            </div>
                        </div>


                        <hr>
                    </div>


                </div>


                <div class="endpoints-group">
                    <h3 id="folder-certifier">
                        Certifier
                        <a href="#folder-certifier"><i class="glyphicon glyphicon-link"></i></a>
                    </h3>

                    <div><p>Endpoints to get, create and remove certifiers.</p>
</div>



                    <div class="request">

                        <h4 id="request-certifier-isaccredited">
                            isAccredited
                            <a href="#request-certifier-isaccredited"><i class="glyphicon glyphicon-link"></i></a>
                        </h4>

                        <div><p>Retrieves the information stored in the blockchain for a certifier identified by its blockchain address.</p>
</div>

                        <div>
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#request-certifier-isaccredited-example-curl" data-toggle="tab">Curl</a></li>
                                <li role="presentation"><a href="#request-certifier-isaccredited-example-http" data-toggle="tab">HTTP</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="request-certifier-isaccredited-example-curl">
                                    <pre><code class="hljs curl">curl -X GET "https://dev-isy.th-luebeck.de/digitalcertapi/certifier/0xb8110bf9829e72cdbbf7b339a3adcf2f61c3d84a"</code></pre>
                                </div>
                                <div class="tab-pane" id="request-certifier-isaccredited-example-http">
                                    <pre><code class="hljs http">GET /digitalcertapi/certifier/0xb8110bf9829e72cdbbf7b339a3adcf2f61c3d84a HTTP/1.1
Host: dev-isy.th-luebeck.de</code></pre>
                                </div>
                            </div>
                        </div>



                        <hr>
                    </div>


                    <div class="request">

                        <h4 id="request-certifier-getinstitutionofcertifier">
                            getInstitutionOfCertifier
                            <a href="#request-certifier-getinstitutionofcertifier"><i class="glyphicon glyphicon-link"></i></a>
                        </h4>

                        <div><p>Retrieves the information stored in the blockchain for an institution a certifier - identified by its blockchain address - belongs to.</p>
</div>

                        <div>
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#request-certifier-getinstitutionofcertifier-example-curl" data-toggle="tab">Curl</a></li>
                                <li role="presentation"><a href="#request-certifier-getinstitutionofcertifier-example-http" data-toggle="tab">HTTP</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="request-certifier-getinstitutionofcertifier-example-curl">
                                    <pre><code class="hljs curl">curl -X GET "https://dev-isy.th-luebeck.de/digitalcertapi/certifier/0xb8110bf9829e72cdbbf7b339a3adcf2f61c3d84a/institution"</code></pre>
                                </div>
                                <div class="tab-pane" id="request-certifier-getinstitutionofcertifier-example-http">
                                    <pre><code class="hljs http">GET /digitalcertapi/certifier/0xb8110bf9829e72cdbbf7b339a3adcf2f61c3d84a/institution HTTP/1.1
Host: dev-isy.th-luebeck.de</code></pre>
                                </div>
                            </div>
                        </div>



                        <hr>
                    </div>


                    <div class="request">

                        <h4 id="request-certifier-createcertifier">
                            createCertifier
                            <a href="#request-certifier-createcertifier"><i class="glyphicon glyphicon-link"></i></a>
                        </h4>

                        <div><p>Creates a certifier that is identified by its blockchain address. This transaction needs to be signed with a private key.</p>
</div>

                        <div>
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#request-certifier-createcertifier-example-curl" data-toggle="tab">Curl</a></li>
                                <li role="presentation"><a href="#request-certifier-createcertifier-example-http" data-toggle="tab">HTTP</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="request-certifier-createcertifier-example-curl">
                                    <pre><code class="hljs curl">curl -X POST -d '{
    "address": "0xb8110bf9829e72cdbbf7b339a3adcf2f61c3d84a",
    "pk": "PRIVATEKEY!123"
}' "https://dev-isy.th-luebeck.de/digitalcertapi/certifier"</code></pre>
                                </div>
                                <div class="tab-pane" id="request-certifier-createcertifier-example-http">
                                    <pre><code class="hljs http">POST /digitalcertapi/certifier HTTP/1.1
Host: dev-isy.th-luebeck.de

{
    "address": "0xb8110bf9829e72cdbbf7b339a3adcf2f61c3d84a",
    "pk": "PRIVATEKEY!123"
}</code></pre>
                                </div>
                            </div>
                        </div>



                        <hr>
                    </div>


                    <div class="request">

                        <h4 id="request-certifier-removecertifier">
                            removeCertifier
                            <a href="#request-certifier-removecertifier"><i class="glyphicon glyphicon-link"></i></a>
                        </h4>

                        <div><p>Removes a certifier identified by its blockchain address. This transaction needs to be signed with a private key.</p>
</div>

                        <div>
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#request-certifier-removecertifier-example-curl" data-toggle="tab">Curl</a></li>
                                <li role="presentation"><a href="#request-certifier-removecertifier-example-http" data-toggle="tab">HTTP</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="request-certifier-removecertifier-example-curl">
                                    <pre><code class="hljs curl">curl -X DELETE -d '{
    "pk": "PRIVATEKEY!123"
}' "https://dev-isy.th-luebeck.de/digitalcertapi/certifier/0xb8110bf9829e72cdbbf7b339a3adcf2f61c3d84a"</code></pre>
                                </div>
                                <div class="tab-pane" id="request-certifier-removecertifier-example-http">
                                    <pre><code class="hljs http">DELETE /digitalcertapi/certifier/0xb8110bf9829e72cdbbf7b339a3adcf2f61c3d84a HTTP/1.1
Host: dev-isy.th-luebeck.de

{
    "pk": "PRIVATEKEY!123"
}</code></pre>
                                </div>
                            </div>
                        </div>



                        <hr>
                    </div>


                    <div class="request">

                        <h4 id="request-certifier-getcontract">
                            getContract
                            <a href="#request-certifier-getcontract"><i class="glyphicon glyphicon-link"></i></a>
                        </h4>

                        <div><p>Retrieves the information stored in the blockchain for a certificate identified by its hash value.</p>
</div>

                        <div>
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#request-certifier-getcontract-example-curl" data-toggle="tab">Curl</a></li>
                                <li role="presentation"><a href="#request-certifier-getcontract-example-http" data-toggle="tab">HTTP</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="request-certifier-getcontract-example-curl">
                                    <pre><code class="hljs curl">curl -X GET "https://dev-isy.th-luebeck.de/digitalcertapi/certifier/contract"</code></pre>
                                </div>
                                <div class="tab-pane" id="request-certifier-getcontract-example-http">
                                    <pre><code class="hljs http">GET /digitalcertapi/certifier/contract HTTP/1.1
Host: dev-isy.th-luebeck.de</code></pre>
                                </div>
                            </div>
                        </div>


                        <div>
                            <ul class="nav nav-tabs" role="tablist">

                                <li role="presentation" class="active">
                                    <a href="#request-certifier-getcontract-responses-21c1b77a-0496-4f09-bd8b-93bb39c2256c" data-toggle="tab">

                                            Response

                                    </a>
                                </li>

                            </ul>
                            <div class="tab-content">

                                <div class="tab-pane active" id="request-certifier-getcontract-responses-21c1b77a-0496-4f09-bd8b-93bb39c2256c">
                                    <table class="table table-bordered">
                                        <tr><th style="width: 20%;">Status</th><td>200 OK</td></tr>

                                        <tr><th style="width: 20%;">Date</th><td>Fri, 27 May 2022 10:07:55 GMT</td></tr>

                                        <tr><th style="width: 20%;">Server</th><td>Apache</td></tr>

                                        <tr><th style="width: 20%;">X-Powered-By</th><td>PHP/7.4.29</td></tr>

                                        <tr><th style="width: 20%;">Cache-Control</th><td>no-cache, private</td></tr>

                                        <tr><th style="width: 20%;">Strict-Transport-Security</th><td>max-age=15768000</td></tr>

                                        <tr><th style="width: 20%;">Upgrade</th><td>h2,h2c</td></tr>

                                        <tr><th style="width: 20%;">Connection</th><td>Upgrade, Keep-Alive</td></tr>

                                        <tr><th style="width: 20%;">Keep-Alive</th><td>timeout=5, max=100</td></tr>

                                        <tr><th style="width: 20%;">Transfer-Encoding</th><td>chunked</td></tr>

                                        <tr><th style="width: 20%;">Content-Type</th><td>application/json</td></tr>



                                            <tr><td class="response-text-sample" colspan="2">
                                                <pre><code>{
    "contract_name": "IdentityManagement",
    "contract_address": "0xBf4Cc235a96A74C359Fb25773764516494a1a031",
    "contract_abi": [
        {
            "constant": true,
            "inputs": [],
            "name": "getCertifiers",
            "outputs": [
                {
                    "name": "",
                    "type": "address[]"
                },
                {
                    "name": "",
                    "type": "bool[]"
                }
            ],
            "payable": false,
            "stateMutability": "view",
            "type": "function"
        },
        {
            "constant": true,
            "inputs": [],
            "name": "isActive",
            "outputs": [
                {
                    "name": "",
                    "type": "bool"
                }
            ],
            "payable": false,
            "stateMutability": "view",
            "type": "function"
        },
        {
            "constant": true,
            "inputs": [],
            "name": "isIdentityManagement",
            "outputs": [
                {
                    "name": "",
                    "type": "bool"
                }
            ],
            "payable": false,
            "stateMutability": "view",
            "type": "function"
        },
        {
            "constant": false,
            "inputs": [
                {
                    "name": "institution",
                    "type": "address"
                },
                {
                    "name": "profile",
                    "type": "bytes32"
                }
            ],
            "name": "registerInstitution",
            "outputs": [],
            "payable": false,
            "stateMutability": "nonpayable",
            "type": "function"
        },
        {
            "constant": true,
            "inputs": [
                {
                    "name": "institution",
                    "type": "address"
                }
            ],
            "name": "getInstitutionProfile",
            "outputs": [
                {
                    "name": "",
                    "type": "bytes32"
                }
            ],
            "payable": false,
            "stateMutability": "view",
            "type": "function"
        },
        {
            "constant": true,
            "inputs": [
                {
                    "name": "institution",
                    "type": "address"
                }
            ],
            "name": "isActiveInstitution",
            "outputs": [
                {
                    "name": "",
                    "type": "bool"
                }
            ],
            "payable": false,
            "stateMutability": "view",
            "type": "function"
        },
        {
            "constant": false,
            "inputs": [],
            "name": "renounceOwnership",
            "outputs": [],
            "payable": false,
            "stateMutability": "nonpayable",
            "type": "function"
        },
        {
            "constant": false,
            "inputs": [
                {
                    "name": "institution",
                    "type": "address"
                },
                {
                    "name": "newProfile",
                    "type": "bytes32"
                }
            ],
            "name": "updateInstitutionProfile",
            "outputs": [],
            "payable": false,
            "stateMutability": "nonpayable",
            "type": "function"
        },
        {
            "constant": true,
            "inputs": [],
            "name": "getInstitutions",
            "outputs": [
                {
                    "name": "",
                    "type": "address[]"
                },
                {
                    "name": "",
                    "type": "bytes32[]"
                }
            ],
            "payable": false,
            "stateMutability": "view",
            "type": "function"
        },
        {
            "constant": true,
            "inputs": [
                {
                    "name": "certifier",
                    "type": "address"
                }
            ],
            "name": "isActiveCertifier",
            "outputs": [
                {
                    "name": "",
                    "type": "bool"
                }
            ],
            "payable": false,
            "stateMutability": "view",
            "type": "function"
        },
        {
            "constant": true,
            "inputs": [],
            "name": "owner",
            "outputs": [
                {
                    "name": "",
                    "type": "address"
                }
            ],
            "payable": false,
            "stateMutability": "view",
            "type": "function"
        },
        {
            "constant": true,
            "inputs": [],
            "name": "isOwner",
            "outputs": [
                {
                    "name": "",
                    "type": "bool"
                }
            ],
            "payable": false,
            "stateMutability": "view",
            "type": "function"
        },
        {
            "constant": false,
            "inputs": [
                {
                    "name": "institution",
                    "type": "address"
                }
            ],
            "name": "reactivateInstitution",
            "outputs": [],
            "payable": false,
            "stateMutability": "nonpayable",
            "type": "function"
        },
        {
            "constant": false,
            "inputs": [
                {
                    "name": "certifier",
                    "type": "address"
                }
            ],
            "name": "blockCertifier",
            "outputs": [],
            "payable": false,
            "stateMutability": "nonpayable",
            "type": "function"
        },
        {
            "constant": false,
            "inputs": [],
            "name": "retire",
            "outputs": [],
            "payable": false,
            "stateMutability": "nonpayable",
            "type": "function"
        },
        {
            "constant": false,
            "inputs": [
                {
                    "name": "certifier",
                    "type": "address"
                }
            ],
            "name": "registerCertifier",
            "outputs": [],
            "payable": false,
            "stateMutability": "nonpayable",
            "type": "function"
        },
        {
            "constant": true,
            "inputs": [
                {
                    "name": "certifier",
                    "type": "address"
                }
            ],
            "name": "isAccreditedCertifier",
            "outputs": [
                {
                    "name": "",
                    "type": "bool"
                }
            ],
            "payable": false,
            "stateMutability": "view",
            "type": "function"
        },
        {
            "constant": false,
            "inputs": [
                {
                    "name": "institution",
                    "type": "address"
                }
            ],
            "name": "deactivateInstitution",
            "outputs": [],
            "payable": false,
            "stateMutability": "nonpayable",
            "type": "function"
        },
        {
            "constant": true,
            "inputs": [
                {
                    "name": "institution",
                    "type": "address"
                }
            ],
            "name": "isRegisteredInstitution",
            "outputs": [
                {
                    "name": "",
                    "type": "bool"
                }
            ],
            "payable": false,
            "stateMutability": "view",
            "type": "function"
        },
        {
            "constant": true,
            "inputs": [
                {
                    "name": "certifier",
                    "type": "address"
                }
            ],
            "name": "getInstitutionFromCertifier",
            "outputs": [
                {
                    "name": "",
                    "type": "address"
                }
            ],
            "payable": false,
            "stateMutability": "view",
            "type": "function"
        },
        {
            "constant": false,
            "inputs": [
                {
                    "name": "newOwner",
                    "type": "address"
                }
            ],
            "name": "transferOwnership",
            "outputs": [],
            "payable": false,
            "stateMutability": "nonpayable",
            "type": "function"
        },
        {
            "inputs": [
                {
                    "name": "es",
                    "type": "address"
                }
            ],
            "payable": false,
            "stateMutability": "nonpayable",
            "type": "constructor"
        },
        {
            "anonymous": false,
            "inputs": [
                {
                    "indexed": true,
                    "name": "caller",
                    "type": "address"
                },
                {
                    "indexed": false,
                    "name": "institution",
                    "type": "address"
                },
                {
                    "indexed": false,
                    "name": "profile",
                    "type": "bytes32"
                }
            ],
            "name": "InstitutionRegistered",
            "type": "event"
        },
        {
            "anonymous": false,
            "inputs": [
                {
                    "indexed": true,
                    "name": "caller",
                    "type": "address"
                },
                {
                    "indexed": false,
                    "name": "institution",
                    "type": "address"
                }
            ],
            "name": "InstitutionDeactivated",
            "type": "event"
        },
        {
            "anonymous": false,
            "inputs": [
                {
                    "indexed": true,
                    "name": "caller",
                    "type": "address"
                },
                {
                    "indexed": false,
                    "name": "institution",
                    "type": "address"
                }
            ],
            "name": "InstitutionReactivated",
            "type": "event"
        },
        {
            "anonymous": false,
            "inputs": [
                {
                    "indexed": true,
                    "name": "caller",
                    "type": "address"
                },
                {
                    "indexed": true,
                    "name": "institution",
                    "type": "address"
                },
                {
                    "indexed": false,
                    "name": "newProfile",
                    "type": "bytes32"
                }
            ],
            "name": "InstitutionProfileUpdated",
            "type": "event"
        },
        {
            "anonymous": false,
            "inputs": [
                {
                    "indexed": true,
                    "name": "institution",
                    "type": "address"
                },
                {
                    "indexed": false,
                    "name": "certifier",
                    "type": "address"
                }
            ],
            "name": "CertifierRegistered",
            "type": "event"
        },
        {
            "anonymous": false,
            "inputs": [
                {
                    "indexed": true,
                    "name": "institution",
                    "type": "address"
                },
                {
                    "indexed": false,
                    "name": "certifier",
                    "type": "address"
                }
            ],
            "name": "CertifierBlocked",
            "type": "event"
        },
        {
            "anonymous": false,
            "inputs": [
                {
                    "indexed": false,
                    "name": "subject",
                    "type": "address"
                },
                {
                    "indexed": false,
                    "name": "object",
                    "type": "address"
                }
            ],
            "name": "Retired",
            "type": "event"
        },
        {
            "anonymous": false,
            "inputs": [
                {
                    "indexed": true,
                    "name": "previousOwner",
                    "type": "address"
                },
                {
                    "indexed": true,
                    "name": "newOwner",
                    "type": "address"
                }
            ],
            "name": "OwnershipTransferred",
            "type": "event"
        }
    ],
    "transaction_hash": "0xfd0a03897e35ecdd7f6e17fc542d1c585f20f43720235c61cb904bbd33a469be"
}</code></pre>
                                            </td></tr>


                                    </table>
                                </div>

                            </div>
                        </div>


                        <hr>
                    </div>


                </div>

            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-2.2.2.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $("table:not(.table)").addClass('table table-bordered');
    });
</script>
</body>
</html>
