<?php
if (!function_exists('dasbor')) {
  function dasbor($role_id) {
    $ci =& get_instance();

        if ($role_id == 1) {
            $ci->simple_admin->cek_login_admin();
            $generate = "
              <div class='row'>
                <!-- left column -->
                <div class='col-md-12'>
                  <!-- general form elements -->
                  <div class='box box-primary'>
                    <div class='box-header with-border'>
                      <h3 class='box-title'>Filter Pencaharian</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form action='".base_url('dasbor')."' method='POST'>
                      <div class='box-body'>
                        <div class='form-group'>
                          <div class='checkbox'>
                            <label>
                              <input type='checkbox' name='semester[]' class='semester1' id='semester1' value='1'>
                              Semster 1
                            </label>
                          </div>
                          <div class='checkbox'>
                            <label>
                              <input type='checkbox' name='semester[]' class='semester2' id='semester2' value='2'>
                              Semster 2
                            </label>
                          </div>
                        </div>
                        <div class='form-group'>
                          <div class='checkbox'>
                            <label>
                              <input type='checkbox' name='kec' class='kec' id='kec' value='KEC.'>
                              Kecamatan
                            </label>
                          </div>
                          <div class='checkbox'>
                            <label>
                              <input type='checkbox' name='kel' class='kel' id='kel' value='KEL.'>
                              Kelurahan
                            </label>
                          </div>
                        </div>
                        <div class='form-group '>
                          <label>Date range:</label>
                          <div class='input-group col-xs-2'>
                            <div class='input-group-addon'>
                              <i class='fa fa-calendar'></i>
                            </div>
                            <input type='text' class='form-control reservation' id='reservation' name='reservation'>
                          </div>
                        </div>
                      </div>
                      <!-- /.box-body -->

                      <div class='box-footer'>
                        <button type='submit' id='sub_filter_chart' class='btn btn-primary'>Submit</button>
                      </div>
                    </form>
                  </div>
                  <!-- /.box -->
                  </div>
                </div>
            ";
            $generate .= "
              <div class='box box-primary'>
                <div class='chart-container'>
                  <canvas id='myChart'></canvas>
                </div>
              </div>
              ";

            $generate .= "
            <div class='box box-primary'>
              <div class='chart-container'>
                <canvas id='myChart2'></canvas>
              </div>
            </div>
            ";
            return $generate;
        }else if ($role_id == 2) {
            $ci->simple_admin->cek_login_faskes();
            $generate = "Dasbor Faske";
            return $generate;
        }else if ($role_id == 3) {
            $ci->simple_admin->cek_login_sudinkes();
            $generate = "Dasbor Sudinkes";
            return $generate;
        }else if ($role_id == 4) {
          $ci->simple_admin->cek_login_penyelia();
          $generate = "
              <div class='row'>
                <!-- left column -->
                <div class='col-md-12'>
                  <!-- general form elements -->
                  <div class='box box-primary'>
                    <div class='box-header with-border'>
                      <h3 class='box-title'>Filter Pencaharian</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form action='".base_url('dasbor')."' method='POST'>
                      <div class='box-body'>
                        <div class='form-group'>
                          <label for='semester'>Smester</label>
                          <select class='form-control semester' id='semester' name='semester'>
                            <option value='1'>Semester 1</option>
                            <option value='2'>Semester 2</option>
                          </select>
                        </div>
                        <div class='form-group'>
                          <label for='faskes_assesment'>Faskes</label>
                          <select name='faskes_assesment[]' class='form-control faskes_assesment' id='nama_assesment' style='width: 100%;' multiple>
                          </select>
                          <div class='help-block with-errors'></div>
                        </div>
                        <div class='form-group'>
                          <label>Date range:</label>
                          <div class='input-group col-xs-2'>
                            <div class='input-group-addon'>
                              <i class='fa fa-calendar'></i>
                            </div>
                            <input type='text' class='form-control reservation' id='reservation' name='reservation'>
                          </div>
                        </div>
                      </div>
                      <!-- /.box-body -->

                      <div class='box-footer'>
                        <button type='submit' id='sub_filter_chart' class='btn btn-primary'>Submit</button>
                      </div>
                    </form>
                  </div>
                  <!-- /.box -->
                  </div>
                </div>
            ";
          $generate .= "
            <div class='box box-primary'>
                <div class='chart-container'>
                  <canvas id='myChart'></canvas>
                </div>
              </div>
              ";
          $generate .= "
            <div class='box box-primary'>
              <div class='chart-container'>
                <canvas id='myChart2'></canvas>
              </div>
            </div>
            ";
            return $generate;
        }
  }
}