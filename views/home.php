
<style>
        .list-buttom{
          display: flex;
          flex-direction: row;
          justify-content: center;
          align-items: left;
          gap: 10px;
          margin-top: 50px;
        }
        .list-buttom2{
          display: flex;
          flex-direction: row;
          justify-content: center;
          align-items: left;
          gap: 10px;
          margin-top: 50px;
        }
        .button-square {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            width: 115px;
            height: 115px;
            background-color: #f0f0f0;
            border: 2px solid #000;
            border-radius: 8px;
            text-decoration: none;
            color: #000;
            font-size: 14px;
            font-weight: bold;
        }

        .button-square:hover {
            background-color: #e0e0e0;
        }

        .button-square svg {
            width: 64px;
            height: 64px;
            fill: #000;
        }

        .button-square p {
            margin: 0;
            padding: 0;
        }
    </style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Inicio</h1>
        </div>
        <div class="col-sm-6">
          
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
            <li class="breadcrumb-item active">Página inicial</li>
          </ol>
          
        </div> 
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">

        <div class="col-md-12">

          <div class="card card-primary card-outline">
            <div class="card-header">
              <h5 class="m-1"><i class="far fa-hand-spock"></i> ¡Bienvenido(a)! <strong><?php echo $_SESSION['loggedInUser']['EMPLOYEE_NAME']; ?></strong></h5>
            </div>
            <div class="card-body">
              <div class="text-center">
                <!--<img class="m-2" src="<?php echo $functions->direct_sistema(); ?>/img/logo.png" alt="" width="250" height="250">-->
                <span class="brand-text font-weight-dark text-cyan text-xl"><strong>Satvicos</strong> Alimentos</span>
    <div class="list-buttom">  
      <div class="button-square">
        <a href="http://localhost/satvicos-master/views/productos/listado-producto" >
        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <defs> <style>.cls-1{fill:#77acf1;}.cls-2{fill:#04009a;}</style> </defs> <g data-name="28. Pile Box" id="_28._Pile_Box"> <path class="cls-1" d="M6,16h4a0,0,0,0,1,0,0v3a1,1,0,0,1-1,1H7a1,1,0,0,1-1-1V16A0,0,0,0,1,6,16Z"></path> <path class="cls-1" d="M22,16h4a0,0,0,0,1,0,0v3a1,1,0,0,1-1,1H23a1,1,0,0,1-1-1V16A0,0,0,0,1,22,16Z"></path> <path class="cls-1" d="M14,4h4a0,0,0,0,1,0,0V7a1,1,0,0,1-1,1H15a1,1,0,0,1-1-1V4A0,0,0,0,1,14,4Z"></path> <path class="cls-2" d="M31,27h-.18A3,3,0,0,0,31,26V18a3,3,0,0,0-3-3H22.82A3,3,0,0,0,23,14V6a3,3,0,0,0-3-3H12A3,3,0,0,0,9,6v8a3,3,0,0,0,.18,1H4a3,3,0,0,0-3,3v8a3,3,0,0,0,.18,1H1a1,1,0,0,0,0,2H31a1,1,0,0,0,0-2ZM11,14V6a1,1,0,0,1,1-1h8a1,1,0,0,1,1,1v8a1,1,0,0,1-1,1H12A1,1,0,0,1,11,14Zm6.18,13H14.82A3,3,0,0,0,15,26V18a3,3,0,0,0-.18-1h2.36A3,3,0,0,0,17,18v8A3,3,0,0,0,17.18,27ZM4,27a1,1,0,0,1-1-1V18a1,1,0,0,1,1-1h8a1,1,0,0,1,1,1v8a1,1,0,0,1-1,1Zm16,0a1,1,0,0,1-1-1V18a1,1,0,0,1,1-1h8a1,1,0,0,1,1,1v8a1,1,0,0,1-1,1Z"></path> <path class="cls-2" d="M7,25H6a1,1,0,0,1,0-2H7a1,1,0,0,1,0,2Z"></path> <path class="cls-2" d="M23,25H22a1,1,0,0,1,0-2h1a1,1,0,0,1,0,2Z"></path> <path class="cls-2" d="M15,13H14a1,1,0,0,1,0-2h1a1,1,0,0,1,0,2Z"></path> </g> </g></svg>
        <p>Almacén</p>
        <P>(F1)</P>
      </div>
      <div class="button-square">
        <a href="http://localhost/satvicos-master/views/proveedores/registro-proveedor" >
        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <defs> <style>.cls-1{fill:#77acf1;}.cls-2{fill:#04009a;}</style> </defs> <g data-name="14. Delivery Truck" id="_14._Delivery_Truck"> <path class="cls-1" d="M7,5h6a0,0,0,0,1,0,0V8.88A1.12,1.12,0,0,1,11.88,10H8.12A1.12,1.12,0,0,1,7,8.88V5A0,0,0,0,1,7,5Z"></path> <path class="cls-2" d="M31.41,17l-1.54-1.54-1.69-5.09A2,2,0,0,0,26.28,9H20V7a3,3,0,0,0-3-3H3A3,3,0,0,0,0,7V22a3,3,0,0,0,3,3H4.14a4,4,0,1,0,0-2H3a1,1,0,0,1-1-1V7A1,1,0,0,1,3,6H17a1,1,0,0,1,1,1V23H15a1,1,0,0,0,0,2h6.14a4,4,0,0,0,7.72,0H30a2,2,0,0,0,2-2V18.41A2,2,0,0,0,31.41,17ZM8,22a2,2,0,1,1-2,2A2,2,0,0,1,8,22Zm19.61-7H24V11h2.28ZM25,26a2,2,0,1,1,2-2A2,2,0,0,1,25,26Zm5-3H28.86a4,4,0,0,0-7.72,0H20V11h2v5a1,1,0,0,0,1,1h5.59L30,18.41Z"></path> </g> </g></svg>
        <p>Proovedores </p>
        <P>(F2)</P>
      </div>
      <div class="button-square">
        <a href="http://localhost/satvicos-master/views/clientes/registro-cliente" >
        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <defs> <style>.cls-1{fill:#77acf1;}.cls-2{fill:#04009a;}</style> </defs> <g data-name="7. Suprised Box" id="_7._Suprised_Box"> <path class="cls-1" d="M13,15h6a0,0,0,0,1,0,0v3.78A1.22,1.22,0,0,1,17.78,20H14.22A1.22,1.22,0,0,1,13,18.78V15A0,0,0,0,1,13,15Z"></path> <path class="cls-2" d="M29.71,10.29a1,1,0,0,0-1.42,0L24.59,14H7.41l-3.7-3.71a1,1,0,0,0-1.42,1.42L6,15.41V29a3,3,0,0,0,3,3H23a3,3,0,0,0,3-3V15.41l3.71-3.7A1,1,0,0,0,29.71,10.29ZM24,29a1,1,0,0,1-1,1H9a1,1,0,0,1-1-1V16H24Z"></path> <path class="cls-2" d="M13,28H11a1,1,0,0,1,0-2h2a1,1,0,0,1,0,2Z"></path> <path class="cls-2" d="M9,10a1,1,0,0,1-.71-.29l-2-2A1,1,0,0,1,7.71,6.29l2,2a1,1,0,0,1,0,1.42A1,1,0,0,1,9,10Z"></path> <path class="cls-2" d="M23,10a1,1,0,0,1-.71-.29,1,1,0,0,1,0-1.42l2-2a1,1,0,1,1,1.42,1.42l-2,2A1,1,0,0,1,23,10Z"></path> <path class="cls-1" d="M22,2.83v.5a2.82,2.82,0,0,1-.3,1.27h0a11.34,11.34,0,0,1-5.1,5.1L16,10l-.6-.3a11.34,11.34,0,0,1-5.1-5.1h0A2.82,2.82,0,0,1,10,3.33v-.5A2.83,2.83,0,0,1,12.83,0h0a2.83,2.83,0,0,1,2,.83L16,2,17.17.83a2.83,2.83,0,0,1,2-.83h0A2.83,2.83,0,0,1,22,2.83Z"></path> </g> </g></svg>
        <p>Clientes</p>
        <p>(F3)</p>
      </div>
      <div class="button-square">
        <a href="http://localhost/satvicos-master/views/productos/registro-producto" >
        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <defs> <style>.cls-1{fill:#77acf1;}.cls-2{fill:#04009a;}</style> </defs> <g data-name="5. Box Check" id="_5._Box_Check"> <path class="cls-1" d="M10,1h6a0,0,0,0,1,0,0V6.13a.87.87,0,0,1-.87.87H10.87A.87.87,0,0,1,10,6.13V1A0,0,0,0,1,10,1Z"></path> <path class="cls-2" d="M11,26H3a3,3,0,0,1-3-3V3A3,3,0,0,1,3,0H23a3,3,0,0,1,3,3v8a1,1,0,0,1-2,0V3a1,1,0,0,0-1-1H3A1,1,0,0,0,2,3V23a1,1,0,0,0,1,1h8a1,1,0,0,1,0,2Z"></path> <path class="cls-2" d="M7,22H5a1,1,0,0,1,0-2H7a1,1,0,0,1,0,2Z"></path> <path class="cls-2" d="M23,32a9,9,0,1,1,9-9A9,9,0,0,1,23,32Zm0-16a7,7,0,1,0,7,7A7,7,0,0,0,23,16Z"></path> <circle class="cls-1" cx="23" cy="23" r="5"></circle> <path class="cls-2" d="M23,26a1,1,0,0,1-.71-.29l-2-2a1,1,0,0,1,1.42-1.42L23,23.59l3.29-3.3a1,1,0,0,1,1.42,1.42l-4,4A1,1,0,0,1,23,26Z"></path> </g> </g></svg>
        <p>Registrar</p>
        <p>(F4)</p>
      </div>
      <div class="button-square">
        <a href="http://localhost/satvicos-master/views/productos/actualizar-stock" >
        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <defs> <style>.cls-1{fill:#77acf1;}.cls-2{fill:#04009a;}</style> </defs> <g data-name="20. Delivery" id="_20._Delivery"> <path class="cls-1" d="M10,1h6a0,0,0,0,1,0,0V6.13a.87.87,0,0,1-.87.87H10.87A.87.87,0,0,1,10,6.13V1A0,0,0,0,1,10,1Z"></path> <path class="cls-2" d="M11,26H3a3,3,0,0,1-3-3V3A3,3,0,0,1,3,0H23a3,3,0,0,1,3,3v8a1,1,0,0,1-2,0V3a1,1,0,0,0-1-1H3A1,1,0,0,0,2,3V23a1,1,0,0,0,1,1h8a1,1,0,0,1,0,2Z"></path> <path class="cls-2" d="M7,22H5a1,1,0,0,1,0-2H7a1,1,0,0,1,0,2Z"></path> <path class="cls-2" d="M23,32a9,9,0,1,1,9-9A9,9,0,0,1,23,32Zm0-16a7,7,0,1,0,7,7A7,7,0,0,0,23,16Z"></path> <path class="cls-1" d="M20,27a1,1,0,0,1-.71-.29,1,1,0,0,1,0-1.42L22,22.59V19a1,1,0,0,1,2,0v4a1,1,0,0,1-.29.71l-3,3A1,1,0,0,1,20,27Z"></path> </g> </g></svg>
        <p>Ajuste</p>
        <p>(F5)</p>
      </div>
    </div>

    <div class="list-buttom2"> 
    <div class="button-square">
        <a href="http://localhost/satvicos-master/views/entradas/entrada-producto" >
        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <defs> <style>.cls-1{fill:#77acf1;}.cls-2{fill:#04009a;}</style> </defs> <g data-name="38. Add Box" id="_38._Add_Box"> <path class="cls-1" d="M10,1h6a0,0,0,0,1,0,0V6.13a.87.87,0,0,1-.87.87H10.87A.87.87,0,0,1,10,6.13V1A0,0,0,0,1,10,1Z"></path> <path class="cls-2" d="M11,26H3a3,3,0,0,1-3-3V3A3,3,0,0,1,3,0H23a3,3,0,0,1,3,3v8a1,1,0,0,1-2,0V3a1,1,0,0,0-1-1H3A1,1,0,0,0,2,3V23a1,1,0,0,0,1,1h8a1,1,0,0,1,0,2Z"></path> <path class="cls-2" d="M7,22H5a1,1,0,0,1,0-2H7a1,1,0,0,1,0,2Z"></path> <path class="cls-2" d="M23,32a9,9,0,1,1,9-9A9,9,0,0,1,23,32Zm0-16a7,7,0,1,0,7,7A7,7,0,0,0,23,16Z"></path> <circle class="cls-1" cx="23" cy="23" r="5"></circle> <path class="cls-2" d="M25,22H24V21a1,1,0,0,0-2,0v1H21a1,1,0,0,0,0,2h1v1a1,1,0,0,0,2,0V24h1a1,1,0,0,0,0-2Z"></path> </g> </g></svg>
        <p>Entradas</p>
        <p>(F6)</p>
      </div>
      <div class="button-square">
        <a href="http://localhost/satvicos-master/views/salidas/salida-producto" >
        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <defs> <style>.cls-1{fill:#77acf1;}.cls-2{fill:#04009a;}</style> </defs> <g data-name="39. Remove Box" id="_39._Remove_Box"> <path class="cls-1" d="M10,1h6a0,0,0,0,1,0,0V6.13a.87.87,0,0,1-.87.87H10.87A.87.87,0,0,1,10,6.13V1A0,0,0,0,1,10,1Z"></path> <path class="cls-2" d="M11,26H3a3,3,0,0,1-3-3V3A3,3,0,0,1,3,0H23a3,3,0,0,1,3,3v8a1,1,0,0,1-2,0V3a1,1,0,0,0-1-1H3A1,1,0,0,0,2,3V23a1,1,0,0,0,1,1h8a1,1,0,0,1,0,2Z"></path> <path class="cls-2" d="M7,22H5a1,1,0,0,1,0-2H7a1,1,0,0,1,0,2Z"></path> <path class="cls-2" d="M23,32a9,9,0,1,1,9-9A9,9,0,0,1,23,32Zm0-16a7,7,0,1,0,7,7A7,7,0,0,0,23,16Z"></path> <circle class="cls-1" cx="23" cy="23" r="5"></circle> <path class="cls-2" d="M25,24H21a1,1,0,0,1,0-2h4a1,1,0,0,1,0,2Z"></path> </g> </g></svg>
        <p>Salidas</p>
        <p>(F7)</p>
      </div>
      <div class="button-square">
        <a href="http://localhost/satvicos-master/views/salidas/salida-producto" >
        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <defs> <style>.cls-1{fill:#77acf1;}.cls-2{fill:#04009a;}</style> </defs> <g data-name="9. Return" id="_9._Return"> <path class="cls-1" d="M14,10h4a0,0,0,0,1,0,0v3a1,1,0,0,1-1,1H15a1,1,0,0,1-1-1V10A0,0,0,0,1,14,10Z"></path> <path class="cls-2" d="M20,23H12a3,3,0,0,1-3-3V12a3,3,0,0,1,3-3h8a3,3,0,0,1,3,3v8A3,3,0,0,1,20,23ZM12,11a1,1,0,0,0-1,1v8a1,1,0,0,0,1,1h8a1,1,0,0,0,1-1V12a1,1,0,0,0-1-1Z"></path> <path class="cls-2" d="M15,19H14a1,1,0,0,1,0-2h1a1,1,0,0,1,0,2Z"></path> <path class="cls-2" d="M30,24.24l-1,4a1,1,0,0,1-.7.72A.84.84,0,0,1,28,29a1,1,0,0,1-.71-.29L26.57,28a15.53,15.53,0,0,1-2.68,1.93l-.51.27A15.85,15.85,0,0,1,16,32,16,16,0,0,1,0,16a15.82,15.82,0,0,1,.44-3.71,1,1,0,0,1,1.94.46A14.16,14.16,0,0,0,2,16,14,14,0,0,0,22.91,28.18l.09-.06a13.31,13.31,0,0,0,2.16-1.54l-.87-.87a1,1,0,0,1-.25-1,1,1,0,0,1,.72-.7l4-1A1,1,0,0,1,30,24.24Z"></path> <path class="cls-2" d="M32,16a15.82,15.82,0,0,1-.44,3.71,1,1,0,0,1-1,.77.85.85,0,0,1-.23,0,1,1,0,0,1-.74-1.2A14.16,14.16,0,0,0,30,16,14,14,0,0,0,9.09,3.82,13.42,13.42,0,0,0,6.84,5.43l.87.86a1,1,0,0,1,.25,1,1,1,0,0,1-.72.7l-4,1L3,9a1,1,0,0,1-.71-.29,1,1,0,0,1-.26-1l1-4A1,1,0,0,1,3.73,3a1,1,0,0,1,1,.25L5.42,4A16.16,16.16,0,0,1,8.11,2.08,16,16,0,0,1,32,16Z"></path> </g> </g></svg>
        <p>Cambio Alm.</p>
        <p>(F8)</p>
      </div>
    </div>
              </div>
            </div>

      
</div>

        </div>
        <!-- /.col-md-6 -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
 
</div>
<!-- /.content-wrapper -->



