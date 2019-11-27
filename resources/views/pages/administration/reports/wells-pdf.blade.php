<!DOCTYPE html>
<html>
<head>
	<title></title>

	 <!-- Bootstrap 3.3.7 -->
<style type="text/css">
  @font-face {
  font-family: SourceSansPro;
  src: url(SourceSansPro-Regular.ttf);
}

.clearfix:after {
  content: "";
  display: table;
  clear: both;
}

a {
  color: #0087C3;
  text-decoration: none;
}

body {
  position: relative;
  width: 19cm;  
  height: 29.7cm; 
  margin: 0 auto; 
  color: #555555;
  background: #FFFFFF; 
  font-family: Arial, sans-serif; 
  font-size: 14px; 
  font-family: SourceSansPro;
}

header {
  padding: 10px 0;
  margin-bottom: 20px;
  border-bottom: 1px solid #AAAAAA;
}

#logo {
  float: left;
  margin-top: 8px;
}

#logo img {
  height: 70px;
}

#company {
  float: right;
  text-align: left;
}


#details {
  margin-bottom: 50px;
}

#client {
  padding-left: 6px;
  border-left: 6px solid #0087C3;
  float: left;
}

#client .to {
  color: #777777;
}

h2.name {
  font-size: 1.4em;
  font-weight: normal;
  margin: 0;
}

#invoice {
  float: right;
  text-align: right;
}

#invoice h1 {
  color: #0087C3;
  font-size: 2.4em;
  line-height: 1em;
  font-weight: normal;
  margin: 0  0 10px 0;
}

#invoice .date {
  font-size: 1.1em;
  color: #777777;
}

table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 20px;
}

table th,
table td {
  padding: 20px;
  background: #EEEEEE;
  text-align: center;
  border-bottom: 1px solid #FFFFFF;
}

table th {
  white-space: nowrap;        
  font-weight: normal;
}

table td {
  text-align: right;
}

table td h3{
  color: #57B223;
  font-size: 1.2em;
  font-weight: normal;
  margin: 0 0 0.2em 0;
}

table .no {
  color: #FFFFFF;
  font-size: 1.6em;
  background: #57B223;
}

table .desc {
  text-align: left;
}

table .unit {
  background: #DDDDDD;
}

table .qty {
}

table .total {
  background: #57B223;
  color: #FFFFFF;
}

table td.unit,
table td.qty,
table td.total {
  font-size: 1.2em;
}

table tbody tr:last-child td {
  border: none;
}

table tfoot td {
  padding: 10px 20px;
  background: #FFFFFF;
  border-bottom: none;
  font-size: 1.2em;
  white-space: nowrap; 
  border-top: 1px solid #AAAAAA; 
}

table tfoot tr:first-child td {
  border-top: none; 
}

table tfoot tr:last-child td {
  color: #57B223;
  font-size: 1.4em;
  border-top: 1px solid #57B223; 

}

table tfoot tr td:first-child {
  border: none;
}

#thanks{
  font-size: 2em;
  margin-bottom: 50px;
}

#notices{
  padding-left: 6px;
  border-left: 6px solid #0087C3; 
  text-align: justify; 
}

#notices .notice {
  font-size: 1.0em;
}

footer {
  color: #777777;
  width: 100%;
  height: 30px;
  position: absolute;
  bottom: 0;
  border-top: 1px solid #AAAAAA;
  padding: 8px 0;
  text-align: center;
}

.page-break {
    page-break-after: always;
}

 </style>

</head>
<body>
	<header class="clearfix">
      <div id="logo">
        <h2>GbSystem</h2>
      </div>
      <div id="company">
        <h2 class="name">Granja Boraure C.A</h2>
        <div>Carora - Estado Lara - 3050</div>
        <div>(0252) 421-7655</div>
        <div><a href="mailto:info@granjaborure.com">info@granjaboraure.com</a></div>
      </div>
      </div>
    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="client">
          <div class="to">REPORTE GENERADO POR:</div>
          @auth
          <h2 class="name">{{ Auth::user()->name }}</h2>
          <div class="email"><a href="mailto:{{ Auth::user()->email }}">{{ Auth::user()->email }}</a></div>
          @endauth
        </div>
        <div id="invoice">
          <h1>GBSystem</h1>
          <div class="date">Fecha de Generacion: {{ $date }}</div>
        </div>
      </div>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>	
          <tr>
            <th class="no">ID</th>
            <th class="desc">NOMBRE</th>
            <th class="unit">Tipo</th>
            <th class="qty">Status</th>
          </tr>
        </thead>
        <tbody>

        @foreach($wells as $well)
          <tr>
            <td class="no">{{ $well->id }}</td>
            <td class="desc"><h3>{{ $well->well_na }}</h3>Creado el: {{ $well->created_at }}</td>
            <td class="unit">{{ $well->type }}</td>
            <td class="qty">{{ $well->status }}</td>
          </tr>
         @endforeach
        </tbody>
        
      </table>
      <div id="thanks">GbSystem!</div>
      <div id="notices">


<!--div class="page-break"></div-->

        <div><strong>AVISO DE CONFIDENCIALIDAD</strong></div>
        <div class="notice">La presente documentación de carácter privado y confidencial es propiedad de Granja Boraure C.A., y esta dirigido exclusivamente a su(s) destinatario(s), no podrá ser objeto de reproducción total o parcial, ni transmisión de ninguna forma o por cualquier medio, ya sea electrónico, mecánico, digital, registro o cualquier otro; tampoco podrá ser distribuido bajo ningún concepto sin el permiso previo y escrito de Granja Boraure, C.A. Si usted ha recibido este documento por error, debe evitar realizar cualquier acción descrita anteriormente, asimismo le agradecemos comunicarlo al remitente. El incumplimiento de las limitaciones señaladas por cualquier persona que tenga acceso a la documentación será sancionada de conformidad al marco jurídico vigente.</div>
      </div>
    </main>
    <footer>
      Salva un árbol...no imprimas este documento a menos que realmente lo necesites.
    </footer>
</body>
</html>

  
   
