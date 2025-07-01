<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ZtrixDev Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
  <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
  <style>
    :root {
      --ztrix-green: #00ffae;
      --ztrix-dark: #0c0f1a;
      --ztrix-panel: #1b1f2f;
      --ztrix-glossy: linear-gradient(135deg, #00ffae, #009970);
      --ztrix-glossy-hover: linear-gradient(135deg, #00e89f, #008b66);
    }

    body {
      background-color: var(--ztrix-dark);
      color: white;
      font-family: 'Segoe UI', sans-serif;
    }

    .sidebar {
      background: var(--ztrix-panel);
      min-height: 100vh;
      padding-top: 1rem;
      position: fixed;
      width: 250px;
      top: 0;
      left: 0;
      z-index: 100;
      box-shadow: 2px 0 10px rgba(0, 0, 0, 0.3);
      transition: left 0.3s ease;
    }

    .sidebar .logo {
      font-size: 1.6rem;
      font-weight: bold;
      color: var(--ztrix-green);
      padding-left: 1rem;
    }

    .sidebar a {
      color: white;
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 0.75rem;
      padding: 0.8rem 1.5rem;
      border-radius: 8px;
      transition: all 0.3s ease;
      margin: 0.3rem 1rem;
    }

    .sidebar a:hover, .sidebar a.active {
      background: var(--ztrix-glossy-hover);
      transform: translateX(6px);
    }

    .navbar {
      margin-left: 250px;
      background: var(--ztrix-panel);
      color: white;
      padding: 1rem;
      display: flex;
      align-items: center;
      gap: 1rem;
      position: sticky;
      top: 0;
      z-index: 1020;
    }

    .navbar .btn {
      z-index: 1021;
    }

    .main {
      margin-left: 250px;
      padding: 2rem;
    }

    .card-custom {
      background-color: var(--ztrix-panel);
      border: none;
      border-radius: 12px;
      padding: 1.5rem;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
      transition: 0.3s ease;
    }

    .card-custom:hover {
      transform: scale(1.03);
      background: var(--ztrix-glossy);
      color: #000;
    }

    .card-title {
      font-size: 1.2rem;
    }

    table.dataTable {
      background-color: var(--ztrix-panel);
      color: white;
      border-radius: 10px;
      overflow: hidden;
    }

    table.dataTable thead {
      background: var(--ztrix-glossy);
      color: black;
    }

    @media (max-width: 768px) {
      .sidebar {
        position: absolute;
        left: -250px;
      }

      .sidebar.show {
        left: 0;
      }

      .navbar, .main {
        margin-left: 0;
      }
    }
  </style>
</head>

<body>
  <div class="sidebar" id="sidebar">
    <div class="logo mb-4"><i class="fa-solid fa-code"></i> ZtrixDev</div>
    <a href="#" class="active"><i class="fa-solid fa-gauge-high"></i><span>Dashboard</span></a>
    <a href="#"><i class="fa-solid fa-diagram-project"></i><span>Projects</span></a>
    <a href="#"><i class="fa-solid fa-users-line"></i><span>Team</span></a>
    <a href="#"><i class="fa-solid fa-chart-pie"></i><span>Analytics</span></a>
    <a href="#"><i class="fa-solid fa-envelope"></i><span>Messages</span> <span class="badge bg-danger ms-auto">●</span></a>
    <a href="#"><i class="fa-solid fa-gear"></i><span>Settings</span></a>
    <hr class="text-white mt-5">
    <div class="text-center text-white fw-bold">
      <div class="bg-success d-inline-block rounded-circle text-dark px-2 py-1">ZD</div>
      Ztrix Developer <i class="fa-solid fa-caret-down"></i>
    </div>
  </div>

  <div class="navbar">
    <button class="btn btn-success" id="menuBtn"><i class="fa-solid fa-bars"></i></button>
    <h5 class="m-0">Dashboard Overview</h5>
  </div>

  <div class="main">
    <div class="row g-4">
      <div class="col-md-6 col-lg-3">
        <div class="card-custom">
          <div class="card-title"><i class="fa-solid fa-folder-open me-2"></i>Total Projects</div>
          <h2 class="text-success">24</h2>
          <small><i class="fa-solid fa-arrow-up text-success"></i> 12% vs last month</small>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="card-custom">
          <div class="card-title"><i class="fa-solid fa-user-check me-2"></i>Active Users</div>
          <h2 class="text-success">1,258</h2>
          <small><i class="fa-solid fa-arrow-up text-success"></i> 8% vs last month</small>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="card-custom">
          <div class="card-title"><i class="fa-solid fa-circle-check me-2"></i>Tasks Completed</div>
          <h2 class="text-danger">156</h2>
          <small><i class="fa-solid fa-arrow-down text-danger"></i> 3% vs last month</small>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="card-custom">
          <div class="card-title"><i class="fa-solid fa-sack-dollar me-2"></i>Revenue</div>
          <h2 class="text-success">$12,345</h2>
          <small><i class="fa-solid fa-arrow-up text-success"></i> 24% vs last month</small>
        </div>
      </div>
    </div>

    <div class="mt-4">
      <div class="card-custom">
        <div class="d-flex justify-content-between align-items-center">
          <div class="fs-5"><i class="fa-solid fa-chart-simple me-2"></i>Performance Analytics</div>
          <select class="form-select w-auto">
            <option selected>This Month</option>
            <option>Last Month</option>
          </select>
        </div>
      </div>
    </div>
  </div>


  <div class="mt-5">
    <div class="card-custom">
      <h5 class="mb-3"><i class="fa-solid fa-table me-2"></i>Data Table</h5>
      <div class="table-responsive">
        <table id="ztrixTable" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Role</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Ridho Undhari</td>
              <td>ridho@example.com</td>
              <td>Developer</td>
              <td><span class="badge bg-success">Active</span></td>
            </tr>
            <tr>
              <td>Reza</td>
              <td>reza@example.com</td>
              <td>Designer</td>
              <td><span class="badge bg-secondary">Pending</span></td>
            </tr>
            <tr>
              <td>Fira</td>
              <td>fira@example.com</td>
              <td>Admin</td>
              <td><span class="badge bg-danger">Inactive</span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
  <script>
    const menuBtn = document.getElementById("menuBtn");
    const sidebar = document.getElementById("sidebar");

    menuBtn?.addEventListener("click", () => {
      sidebar.classList.toggle("show");
    });

    // Datatable
    $(document).ready(function () {
      $('#ztrixTable').DataTable();
    });
  </script>
</body>

</html>
