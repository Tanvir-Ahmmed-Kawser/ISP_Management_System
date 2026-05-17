<?php
require_once __DIR__ . '/../models/authModel.php';
require_once __DIR__ . '/../models/categoryModel.php';
require_once __DIR__ . '/../models/contentModel.php';

$csrfToken = task4CreateCsrfToken();
$pageTitle = 'Member Browse - ISP Media FTP';
$topCategories = task4GetTopCategories();
$requestCategories = task4GetAllCategories();
$highlightedContents = task4GetHighlightedContents();
$allContents = task4SearchContents('', 0, 0, '');

include __DIR__ . '/header.php';
?>

<main class="container">
    <section class="hero-section">
        <div>
            <span class="tagline">Unregistered Member Access</span>
            <h2>Browse, search, filter and request ISP hosted media content.</h2>
            <p>Members do not need login. They can browse available movies, software, TV series, games and request missing content.</p>
        </div>
        <div class="hero-count">
            <strong id="contentCount"><?php echo mysqli_num_rows($allContents); ?></strong>
            <span>Available Contents</span>
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
            <h2>Highlighted Contents</h2>
            <p>Most downloaded and recently uploaded media.</p>
        </div>

        <div class="content-grid">
            <?php if($highlightedContents && mysqli_num_rows($highlightedContents) > 0){ ?>
                <?php while($item = mysqli_fetch_assoc($highlightedContents)){ ?>
                    <div class="content-card">
                        <div class="card-meta">
                            <span><?php echo htmlspecialchars(($item['parent_category_name'] ? $item['parent_category_name'] . ' / ' : '') . ($item['category_name'] ?: 'General')); ?></span>
                            <small><?php echo (int)$item['download_count']; ?> downloads</small>
                        </div>
                        <h3><?php echo htmlspecialchars($item['title']); ?></h3>
                        <p><?php echo htmlspecialchars(strlen($item['description']) > 110 ? substr($item['description'], 0, 110) . '...' : $item['description']); ?></p>
                        <a class="btn" href="../controllers/downloadController.php?id=<?php echo (int)$item['id']; ?>">Download</a>
                    </div>
                <?php } ?>
            <?php }else{ ?>
                <p>No highlighted content available.</p>
            <?php } ?>
        </div>
    </section>

    <section class="section-box" id="browseSection">
        <div class="section-heading">
            <h2>Browse, Search and Filter</h2>
            <p>AJAX search by title/description with category, sub-category and file type filters.</p>
        </div>

        <div class="filter-panel">
            <div class="form-group wide-field">
                <label for="searchInput">Search</label>
                <input type="text" id="searchInput" placeholder="Search by title or description">
            </div>

            <div class="form-group">
                <label for="categoryFilter">Category</label>
                <select id="categoryFilter">
                    <option value="">All Categories</option>
                    <?php mysqli_data_seek($topCategories, 0); ?>
                    <?php while($category = mysqli_fetch_assoc($topCategories)){ ?>
                        <option value="<?php echo (int)$category['id']; ?>"><?php echo htmlspecialchars($category['name']); ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label for="subcategoryFilter">Sub-category</label>
                <select id="subcategoryFilter" disabled>
                    <option value="">All Sub-categories</option>
                </select>
            </div>

            <div class="form-group">
                <label for="fileTypeFilter">File Type</label>
                <select id="fileTypeFilter">
                    <option value="">Any Type</option>
                    <option value="mp4">MP4</option>
                    <option value="mkv">MKV</option>
                    <option value="pdf">PDF</option>
                    <option value="zip">ZIP</option>
                    <option value="rar">RAR</option>
                    <option value="exe">EXE</option>
                    <option value="txt">TXT</option>
                </select>
            </div>

            <button type="button" class="btn outline-btn" id="clearFiltersBtn">Clear</button>
        </div>

        <div id="contentResult" class="content-grid">
            <?php if($allContents && mysqli_num_rows($allContents) > 0){ ?>
                <?php while($item = mysqli_fetch_assoc($allContents)){ ?>
                    <div class="content-card">
                        <div class="card-meta">
                            <span><?php echo htmlspecialchars(($item['parent_category_name'] ? $item['parent_category_name'] . ' / ' : '') . ($item['category_name'] ?: 'General')); ?></span>
                            <small><?php echo (int)$item['download_count']; ?> downloads</small>
                        </div>
                        <h3><?php echo htmlspecialchars($item['title']); ?></h3>
                        <p><?php echo htmlspecialchars($item['description']); ?></p>
                        <div class="card-actions">
                            <a class="btn" href="../controllers/downloadController.php?id=<?php echo (int)$item['id']; ?>">Download</a>
                            <span class="file-pill"><?php echo htmlspecialchars(strtoupper(pathinfo($item['file_path'], PATHINFO_EXTENSION) ?: 'FILE')); ?></span>
                        </div>
                    </div>
                <?php } ?>
            <?php }else{ ?>
                <p>No content found.</p>
            <?php } ?>
        </div>
    </section>

    <section class="section-box" id="requestBox">
        <div class="section-heading">
            <h2>Request Box</h2>
            <p>Members can request missing media content through AJAX.</p>
        </div>

        <form id="requestForm" class="task-form" method="POST" action="../controllers/requestController.php" novalidate>
            <div class="form-group wide-field">
                <label for="contentTitle">Content Title</label>
                <input type="text" id="contentTitle" name="content_title" placeholder="Example: Ubuntu ISO, Avengers, FIFA setup" maxlength="100" required>
            </div>

            <div class="form-group">
                <label for="requestCategory">Category</label>
                <select id="requestCategory" name="category_id" required>
                    <option value="">Select Category</option>
                    <?php while($category = mysqli_fetch_assoc($requestCategories)){ ?>
                        <?php $label = $category['parent_name'] ? $category['parent_name'] . ' / ' . $category['name'] : $category['name']; ?>
                        <option value="<?php echo (int)$category['id']; ?>"><?php echo htmlspecialchars($label); ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group wide-field">
                <label for="requestMessage">Additional Message</label>
                <textarea id="requestMessage" name="message" rows="4" placeholder="Optional details such as version, quality, year or language"></textarea>
            </div>

            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken); ?>">
            <button type="submit" class="btn">Submit Request</button>
            <p id="requestResponse" class="form-message"></p>
        </form>
    </section>
</main>

<script>
    window.TASK4_CSRF_TOKEN = "<?php echo htmlspecialchars($csrfToken); ?>";
</script>

<?php include __DIR__ . '/footer.php'; ?>
