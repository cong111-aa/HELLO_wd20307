<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'Tour Manager' ?> - Admin Panel</title>

    <!-- Google Font: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3 + Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #6366f1;
            --primary-hover: #4f46e5;
            --sidebar-width: 270px;
            --sidebar-bg: #1e293b;
            --sidebar-active: #6366f1;
            --text-muted: #94a3b8;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            min-height: 100vh;
            color: #334155;
        }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--sidebar-bg);
            color: white;
            padding: 0;
            box-shadow: 8px 0 25px rgba(0, 0, 0, 0.15);
            z-index: 1000;
            overflow-y: auto;
            transition: all 0.3s ease;
        }

        .sidebar-header {
            padding: 1.8rem 1.5rem;
            background: rgba(255, 255, 255, 0.05);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-header h4 {
            margin: 0;
            font-weight: 700;
            font-size: 1.4rem;
            color: #fff;
        }

        .sidebar-header small {
            opacity: 0.8;
            font-size: 0.85rem;
        }

        .nav-sidebar {
            padding: 1rem 0;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 20px;
            color: #cbd5e1;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.25s ease;
            border-left: 3px solid transparent;
        }

        .menu-item:hover {
            background: rgba(99, 102, 241, 0.15);
            color: white;
            border-left-color: var(--primary);
            padding-left: 24px;
        }

        .menu-item.active {
            background: rgba(99, 102, 241, 0.25);
            color: white;
            border-left: 4px solid var(--primary);
            font-weight: 600;
        }

        .menu-item i {
            font-size: 1.2rem;
            width: 24px;
        }

        .menu-item.logout {
            color: #fca5a5 !important;
        }

        .menu-item.logout:hover {
            background: rgba(239, 68, 68, 0.2) !important;
            border-left-color: #ef4444;
        }

        /* CONTENT */
        .content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: all 0.3s;
        }

        .topbar {
            background: white;
            padding: 1rem 2rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
            border-bottom: 1px solid #e2e8f0;
            position: sticky;
            top: 0;
            z-index: 900;
        }

        .user-dropdown .dropdown-toggle {
            background: none;
            border: none;
            font-weight: 600;
            color: #1e293b;
        }

        .user-dropdown .dropdown-toggle::after {
            display: none;
        }

        /* Card nâng cao */
        .card-modern {
            border: none;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .card-modern:hover {
            transform: translateY(-5px);
        }

        /* Responsive */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .content {
                margin-left: 0;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .mobile-toggle {
                display: block !important;
            }
        }

        .mobile-toggle {
            display: none;
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 1100;
            background: var(--primary);
            color: white;
            border: none;
            width: 50px;
            height: 50px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
        }
    </style>
</head>

<body>

    <!-- Mobile Menu Toggle -->
    <button class="mobile-toggle" onclick="document.querySelector('.sidebar').classList.toggle('show')">
        <i class="bi bi-list fs-3"></i>
    </button>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h4>TravelAdmin</h4>
            <small class="d-block opacity-75">Quản trị hệ thống</small>
        </div>

        <div class="nav-sidebar">
            <?php if (!empty($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                <a class="menu-item <?= ($active ?? '') === 'dashboard' ? 'active' : '' ?>"
                    href="index.php?controller=adminDashboard&action=index">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>

                <a class="menu-item <?= ($active ?? '') === 'tours' ? 'active' : '' ?>"
                    href="index.php?controller=adminTour&action=index">
                    <i class="bi bi-map-fill"></i> Quản lý Tour
                </a>

                <a class="menu-item <?= ($active ?? '') === 'bookings' ? 'active' : '' ?>"
                    href="index.php?controller=adminBooking&action=index">
                    <i class="bi bi-calendar-check-fill"></i> Đơn đặt tour
                </a>

                <a class="menu-item <?= ($active ?? '') === 'partner' ? 'active' : '' ?>"
                    href="index.php?controller=partner&action=index">
                    <i class="bi bi-building"></i> Đối tác
                </a>

                <a class="menu-item <?= ($active ?? '') === 'staff' ? 'active' : '' ?>"
                    href="index.php?controller=guideAdmin&action=index">
                    <i class="bi bi-person-badge-fill"></i> Nhân sự & Hướng dẫn viên
                </a>

                <a class="menu-item <?= ($active ?? '') === 'checkin' ? 'active' : '' ?>"
                    href="index.php?controller=adminCheckin&action=bookingList">
                    <i class="bi bi-check2-circle"></i> Check-in khách
                </a>
                <li>
                    <a class="menu-item <?= ($active ?? '') === 'diary' ? 'active' : '' ?>"
                        href="index.php?controller=adminDiary&action=assignmentList">
                        <i class="bi bi-check2-circle"></i> nhật ký tour
                    </a>
                </li>

                <div class="border-top border-secondary-subtle my-3 mx-4"></div>

                <a class="menu-item logout" href="index.php?controller=auth&action=logout">
                    <i class="bi bi-box-arrow-right"></i> Đăng xuất
                </a>

            <?php elseif (!empty($_SESSION['user']) && $_SESSION['user']['role'] === 'guide'): ?>
                <a class="menu-item <?= ($active ?? '') === 'dashboard' ? 'active' : '' ?>"
                    href="index.php?controller=guide&action=dashboard">
                    <i class="bi bi-speedometer2"></i> Trang chủ HDV
                </a>



                <div class="border-top border-secondary-subtle my-3 mx-4"></div>

                <a class="menu-item logout" href="index.php?controller=auth&action=logout">
                    <i class="bi bi-box-arrow-right"></i> Đăng xuất
                </a>
            <?php endif; ?>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="content">
        <!-- Topbar -->
        <div class="topbar d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold text-dark">
                <?= $pageTitle ?? 'Dashboard' ?>
            </h5>

            <?php if (!empty($_SESSION['user'])): ?>
                <div class="dropdown user-dropdown">
                    <button class="dropdown-toggle d-flex align-items-center gap-2" data-bs-toggle="dropdown">
                        <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                            style="width:40px;height:40px;font-weight:bold;">
                            <?= strtoupper(substr($_SESSION['user']['name'], 0, 2)) ?>
                        </div>
                        <div class="text-start">
                            <div class="fw-semibold"><?= htmlspecialchars($_SESSION['user']['name']) ?></div>
                            <small class="text-muted text-capitalize"><?= $_SESSION['user']['role'] ?></small>
                        </div>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i> Hồ sơ</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item text-danger" href="index.php?controller=auth&action=logout">
                                <i class="bi bi-box-arrow-right me-2"></i> Đăng xuất
                            </a></li>
                    </ul>
                </div>
            <?php endif; ?>
        </div>

        <!-- Page Content -->
        <div class="p-4">
            <?php include $viewFile; ?>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Tự động đóng sidebar khi click ngoài trên mobile -->
    <script>
        document.addEventListener('click', function (e) {
            if (window.innerWidth <= 992) {
                if (!e.target.closest('.sidebar') && !e.target.closest('.mobile-toggle')) {
                    document.querySelector('.sidebar').classList.remove('show');
                }
            }
        });
    </script>
</body>

</html>