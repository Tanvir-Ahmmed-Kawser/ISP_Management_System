<?php
require_once __DIR__ . '/../models/authModel.php';
require_once __DIR__ . '/../models/requestModel.php';

task4RequireAdminOrModerator();
$csrfToken = task4CreateCsrfToken();
$pageTitle = 'Manage Content Requests - ISP Media FTP';
$requests = task4GetAllContentRequests();

include __DIR__ . '/header.php';
?>

<main class="container">
    <section class="hero-section slim-hero">
        <div>
            <span class="tagline">Admin / Moderator Access</span>
            <h2>View and manage member content requests.</h2>
            <p>Pending requests can be marked as fulfilled or rejected after checking content availability.</p>
        </div>
    </section>

    <?php if(!empty($_SESSION['task4_success'])){ ?>
        <p class="alert success-alert"><?php echo htmlspecialchars($_SESSION['task4_success']); unset($_SESSION['task4_success']); ?></p>
    <?php } ?>

    <?php if(!empty($_SESSION['task4_error'])){ ?>
        <p class="alert error-alert"><?php echo htmlspecialchars($_SESSION['task4_error']); unset($_SESSION['task4_error']); ?></p>
    <?php } ?>

    <section class="section-box">
        <div class="section-heading">
            <h2>Content Requests</h2>
            <p>Status update uses AJAX JSON and also has a normal controller fallback.</p>
        </div>

        <div class="table-wrapper">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Message</th>
                        <th>Requester</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($requests && mysqli_num_rows($requests) > 0){ ?>
                        <?php while($request = mysqli_fetch_assoc($requests)){ ?>
                            <tr id="requestRow<?php echo (int)$request['id']; ?>">
                                <td><?php echo htmlspecialchars($request['content_title']); ?></td>
                                <td><?php echo htmlspecialchars($request['category_requested']); ?></td>
                                <td><?php echo htmlspecialchars($request['message']); ?></td>
                                <td><?php echo htmlspecialchars($request['requester_ip']); ?></td>
                                <td>
                                    <span class="status-pill status-<?php echo htmlspecialchars($request['status']); ?>">
                                        <?php echo htmlspecialchars(ucfirst($request['status'])); ?>
                                    </span>
                                </td>
                                <td><?php echo htmlspecialchars($request['created_at']); ?></td>
                                <td>
                                    <form class="status-form" method="POST" action="../controllers/requestStatusController.php">
                                        <input type="hidden" name="request_id" value="<?php echo (int)$request['id']; ?>">
                                        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken); ?>">
                                        <select name="status" class="status-select">
                                            <option value="pending" <?php echo $request['status'] === 'pending' ? 'selected' : ''; ?>>Pending</option>
                                            <option value="fulfilled" <?php echo $request['status'] === 'fulfilled' ? 'selected' : ''; ?>>Fulfilled</option>
                                            <option value="rejected" <?php echo $request['status'] === 'rejected' ? 'selected' : ''; ?>>Rejected</option>
                                        </select>
                                        <button type="submit" class="btn small-btn">Update</button>
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php }else{ ?>
                        <tr>
                            <td colspan="7">No content requests found.</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </section>
</main>

<script>
    window.TASK4_CSRF_TOKEN = "<?php echo htmlspecialchars($csrfToken); ?>";
</script>

<?php include __DIR__ . '/footer.php'; ?>
