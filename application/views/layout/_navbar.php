
<div id="header" class="page-navbar">
    <!-- .navbar-brand -->
    <a href="index.html" class="navbar-brand hidden-xs hidden-sm">
        <!--<img src="<?php echo base_url('public/img/logo_sgo12.png') ?>" class="logo hidden-xs" alt="Dynamic logo">-->
        <!--<img src="<?php echo base_url('public/img/logosm.png') ?>" class="logo-sm hidden-lg hidden-md" alt="Dynamic logo">-->
    </a>
    <!-- / navbar-brand -->
    <!-- .no-collapse -->
    <div id="navbar-no-collapse" class="navbar-no-collapse">
        <!-- top left nav -->
        <ul class="nav navbar-nav">
            <li class="toggle-sidebar">
                <a href="#">
                    <i class="fa fa-reorder"></i>
                    <span class="sr-only">Collapse sidebar</span>
                </a>
            </li>
            <li>
                <a href="#" class="reset-layout tipB" title="Reset panel position for this page"><i class="fa fa-history"></i></a>
            </li>
        </ul>
        <!-- / top left nav -->
        <!-- top right nav -->
        <ul class="nav navbar-nav navbar-right">
<!--                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="sr-only">Notifications</span>
                            <span class="badge badge-danger">6</span>
                        </a>
                        <ul class="dropdown-menu right dropdown-notification" role="menu">
                            <li><a href="#" class="dropdown-menu-header">Notifications</a>
                            </li>
                            <li><a href="#"><i class="l-basic-life-buoy"></i> 2 support request</a>
                            </li>
                            <li><a href="#"><i class="l-basic-gear"></i> Settings is changed</a>
                            </li>
                            <li><a href="#"><i class="l-weather-lightning"></i> 5 min server downtime</a>
                            </li>
                            <li><a href="#"><i class="l-basic-server2"></i> Databse backup is complete</a>
                            </li>
                            <li><a href="#"><i class="l-basic-lightbulb"></i> SuggeElson push 1 commit</a>
                            </li>
                            <li><a href="#" class="view-all">View all <i class="l-arrows-right"></i> </a>
                            </li>
                        </ul>
                    </li>-->
<!--                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown">
                            <i class="fa fa-cog"></i>
                            <span class="sr-only">Settings</span>
                        </a>
                        <ul class="dropdown-menu dropdown-form dynamic-settings right" role="menu">
                            <li><a href="#" class="dropdown-menu-header">Template settings</a>
                            </li>
                            <li>
                                <div class="toggle-custom">
                                    <label class="toggle" data-on="ON" data-off="OFF">
                                        <input type="checkbox" id="fixed-header-toggle" name="fixed-header-toggle" checked>
                                        <span class="button-checkbox"></span>
                                    </label>
                                    <label for="fixed-header-toggle">Fixed header</label>
                                </div>
                            </li>
                            <li>
                                <div class="toggle-custom">
                                    <label class="toggle" data-on="ON" data-off="OFF">
                                        <input type="checkbox" id="fixed-left-sidebar" name="fixed-left-sidebar" checked>
                                        <span class="button-checkbox"></span>
                                    </label>
                                    <label for="fixed-left-sidebar">Fixed Left Sidebar</label>
                                </div>
                            </li>
                            <li>
                                <div class="toggle-custom">
                                    <label class="toggle" data-on="ON" data-off="OFF">
                                        <input type="checkbox" id="fixed-right-sidebar" name="fixed-right-sidebar" checked>
                                        <span class="button-checkbox"></span>
                                    </label>
                                    <label for="fixed-right-sidebar">Fixed Right Sidebar</label>
                                </div>
                            </li>
                        </ul>
                    </li>-->
                    <li>
                        <a href="#" data-target="#logoutModal" data-toggle="modal">
                            <i class="fa fa-power-off"></i>
                            <span class="sr-only">Logout</span>
                        </a>
                    </li>
<!--                    <li>
                        <a id="toggle-right-sidebar" href="#" class="tipB" title="Toggle right sidebar">
                            <i class="l-software-layout-sidebar-right"></i>
                            <span class="sr-only">Toggle right sidebar</span>
                        </a>
                    </li>-->
                </ul>
        <!-- / top right nav -->
    </div>
    <!-- / collapse -->
</div>

<div class="modal" id="logoutModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Pronto para sair?</h5>
      </div>
      <div class="modal-body">
        <p>Clique em "Sair" para encerrar a sessão.</p>
      </div>
      <div class="modal-footer">
          <a type="button" href="<?php echo base_url('login/logout') ?>" class="btn btn-primary">Sair</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>