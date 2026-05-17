// Task 4 - 23-53221-3
// Member AJAX search/filter, request box validation, and admin/moderator request status update

function task4SafeText(value){
    return String(value ?? '')
        .replaceAll('&', '&amp;')
        .replaceAll('<', '&lt;')
        .replaceAll('>', '&gt;')
        .replaceAll('"', '&quot;')
        .replaceAll("'", '&#039;');
}

function task4RenderContents(contents){
    const resultBox = document.getElementById('contentResult');
    const countBox = document.getElementById('contentCount');

    if(!resultBox){
        return;
    }

    if(countBox){
        countBox.textContent = contents.length;
    }

    if(contents.length === 0){
        resultBox.innerHTML = '<p>No content matched your search/filter.</p>';
        return;
    }

    let html = '';

    contents.forEach(function(item){
        const category = item.parent_category_name
            ? item.parent_category_name + ' / ' + item.category_name
            : (item.category_name || 'General');
        const extension = (item.file_path || 'file').split('.').pop().toUpperCase();

        html += `
            <div class="content-card">
                <div class="card-meta">
                    <span>${task4SafeText(category)}</span>
                    <small>${task4SafeText(item.download_count)} downloads</small>
                </div>
                <h3>${task4SafeText(item.title)}</h3>
                <p>${task4SafeText(item.description)}</p>
                <div class="card-actions">
                    <a class="btn" href="../controllers/downloadController.php?id=${encodeURIComponent(item.id)}">Download</a>
                    <span class="file-pill">${task4SafeText(extension)}</span>
                </div>
            </div>
        `;
    });

    resultBox.innerHTML = html;
}

function task4LoadContents(){
    const searchInput = document.getElementById('searchInput');
    const categoryFilter = document.getElementById('categoryFilter');
    const subcategoryFilter = document.getElementById('subcategoryFilter');
    const fileTypeFilter = document.getElementById('fileTypeFilter');

    if(!searchInput || !categoryFilter || !subcategoryFilter || !fileTypeFilter){
        return;
    }

    const params = new URLSearchParams({
        q: searchInput.value.trim(),
        category_id: categoryFilter.value,
        subcategory_id: subcategoryFilter.value,
        file_type: fileTypeFilter.value
    });

    fetch('../api/contents/search.php?' + params.toString())
        .then(function(response){
            return response.json();
        })
        .then(function(data){
            if(!data.success){
                task4RenderContents([]);
                return;
            }

            task4RenderContents(data.contents);
        })
        .catch(function(){
            const resultBox = document.getElementById('contentResult');
            if(resultBox){
                resultBox.innerHTML = '<p>Something went wrong while loading contents.</p>';
            }
        });
}

function task4LoadSubCategories(categoryId){
    const subcategoryFilter = document.getElementById('subcategoryFilter');

    if(!subcategoryFilter){
        return;
    }

    subcategoryFilter.innerHTML = '<option value="">All Sub-categories</option>';
    subcategoryFilter.disabled = true;

    if(categoryId === ''){
        return;
    }

    fetch('../api/contents/subcategories.php?category_id=' + encodeURIComponent(categoryId))
        .then(function(response){
            return response.json();
        })
        .then(function(data){
            if(!data.success || data.subcategories.length === 0){
                return;
            }

            let html = '<option value="">All Sub-categories</option>';

            data.subcategories.forEach(function(item){
                html += `<option value="${task4SafeText(item.id)}">${task4SafeText(item.name)}</option>`;
            });

            subcategoryFilter.innerHTML = html;
            subcategoryFilter.disabled = false;
        });
}

function task4SetupBrowseFilters(){
    const searchInput = document.getElementById('searchInput');
    const categoryFilter = document.getElementById('categoryFilter');
    const subcategoryFilter = document.getElementById('subcategoryFilter');
    const fileTypeFilter = document.getElementById('fileTypeFilter');
    const clearBtn = document.getElementById('clearFiltersBtn');

    if(!searchInput || !categoryFilter || !subcategoryFilter || !fileTypeFilter){
        return;
    }

    let timer = null;

    searchInput.addEventListener('input', function(){
        clearTimeout(timer);
        timer = setTimeout(task4LoadContents, 250);
    });

    categoryFilter.addEventListener('change', function(){
        task4LoadSubCategories(categoryFilter.value);
        task4LoadContents();
    });

    subcategoryFilter.addEventListener('change', task4LoadContents);
    fileTypeFilter.addEventListener('change', task4LoadContents);

    if(clearBtn){
        clearBtn.addEventListener('click', function(){
            searchInput.value = '';
            categoryFilter.value = '';
            subcategoryFilter.innerHTML = '<option value="">All Sub-categories</option>';
            subcategoryFilter.disabled = true;
            fileTypeFilter.value = '';
            task4LoadContents();
        });
    }
}

function task4SetupRequestForm(){
    const form = document.getElementById('requestForm');
    const responseBox = document.getElementById('requestResponse');

    if(!form){
        return;
    }

    form.addEventListener('submit', function(event){
        event.preventDefault();

        const title = form.content_title.value.trim();
        const category = form.category_id.value;
        const message = form.message.value.trim();

        if(title === ''){
            responseBox.textContent = 'Content title is required.';
            responseBox.className = 'form-message error-text';
            return;
        }

        if(title.length < 2 || title.length > 100){
            responseBox.textContent = 'Title must be between 2 and 100 characters.';
            responseBox.className = 'form-message error-text';
            return;
        }

        if(category === ''){
            responseBox.textContent = 'Please select a category.';
            responseBox.className = 'form-message error-text';
            return;
        }

        if(message.length > 500){
            responseBox.textContent = 'Message cannot exceed 500 characters.';
            responseBox.className = 'form-message error-text';
            return;
        }

        const formData = new FormData(form);
        responseBox.textContent = 'Submitting request...';
        responseBox.className = 'form-message';

        fetch('../api/requests/add.php', {
            method: 'POST',
            body: formData
        })
            .then(function(response){
                return response.json();
            })
            .then(function(data){
                responseBox.textContent = data.message;
                responseBox.className = data.success ? 'form-message success-text' : 'form-message error-text';

                if(data.success){
                    form.reset();
                }
            })
            .catch(function(){
                responseBox.textContent = 'Request could not be submitted.';
                responseBox.className = 'form-message error-text';
            });
    });
}

function task4SetupStatusForms(){
    const forms = document.querySelectorAll('.status-form');

    forms.forEach(function(form){
        form.addEventListener('submit', function(event){
            event.preventDefault();

            const formData = new FormData(form);

            fetch('../api/requests/update_status.php', {
                method: 'POST',
                body: formData
            })
                .then(function(response){
                    return response.json();
                })
                .then(function(data){
                    alert(data.message);

                    if(data.success){
                        window.location.reload();
                    }
                })
                .catch(function(){
                    alert('Status update failed.');
                });
        });
    });
}

document.addEventListener('DOMContentLoaded', function(){
    task4SetupBrowseFilters();
    task4SetupRequestForm();
    task4SetupStatusForms();
});
