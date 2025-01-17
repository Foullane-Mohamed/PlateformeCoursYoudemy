<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy Tags Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }
        .tag-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
        }
    </style>
</head>
<body class="h-full">
    <div class="min-h-screen bg-gray-50 flex">
        <!-- Sidebar -->
        <aside class="hidden lg:flex lg:flex-col lg:w-72 lg:fixed lg:inset-y-0 bg-white border-r border-gray-200">
            <!-- Logo -->
            <div class="flex items-center h-16 px-6 border-b border-gray-200 bg-white">
                <div class="flex items-center gap-2">
                    <div class="bg-indigo-600 p-2 rounded-lg">
                        <i class="fas fa-graduation-cap text-white"></i>
                    </div>
                    <span class="text-xl font-bold text-gray-900">Youdemy</span>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 py-6 space-y-8 overflow-y-auto">
                <!-- Main Navigation -->
                <div>
                    <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Main</h3>
                    <div class="mt-4 space-y-1">
                        <a href="dashboard.php" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg text-gray-600 hover:bg-gray-50">
                            <i class="fas fa-chart-line w-5 h-5"></i>
                            <span class="ml-3">Dashboard</span>
                        </a>
                        <a href="#" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg bg-indigo-50 text-indigo-600">
                            <i class="fas fa-tags w-5 h-5"></i>
                            <span class="ml-3">Tags</span>
                        </a>
                    </div>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="lg:pl-72 flex flex-col flex-1">
            <!-- Top Navigation -->
            <header class="sticky top-0 z-10 bg-white border-b border-gray-200">
                <div class="px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex items-center justify-between">
                        <!-- Search and Filters -->
                        <div class="flex items-center gap-4">
                            <div class="relative">
                                <input type="text"
                                       placeholder="Search tags..."
                                       class="w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-search text-gray-400"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Add New Tag Button -->
                        <button onclick="openModal()" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <i class="fas fa-plus mr-2"></i>
                            Add New Tag
                        </button>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-6">
                <!-- Page Header -->
                <div class="mb-8">
                    <h1 class="text-2xl font-bold text-gray-900">Tags Management</h1>
                </div>

                <!-- Stats Overview -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- Total Tags -->
                    <div class="bg-white p-6 rounded-xl border border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Total Tags</p>
                                <p class="text-2xl font-bold text-gray-900 mt-1">248</p>
                            </div>
                            <div class="p-3 bg-indigo-50 rounded-lg">
                                <i class="fas fa-tags text-indigo-600 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Most Used Tags -->
                    <div class="bg-white p-6 rounded-xl border border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Most Used</p>
                                <p class="text-2xl font-bold text-gray-900 mt-1">Programming</p>
                            </div>
                            <div class="p-3 bg-green-50 rounded-lg">
                                <i class="fas fa-chart-line text-green-600 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Unused Tags -->
                    <div class="bg-white p-6 rounded-xl border border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Unused Tags</p>
                                <p class="text-2xl font-bold text-gray-900 mt-1">12</p>
                            </div>
                            <div class="p-3 bg-amber-50 rounded-lg">
                                <i class="fas fa-exclamation-circle text-amber-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tags Grid -->
                <div class="tag-grid">
                    <?php
                    require_once __DIR__ . '/../../config/connection.php';
                    require_once __DIR__ . '/../../models/Tag.php';

                    $tag = new Tag();
                    $tags = $tag->getAllTags();
                    foreach ($tags as $tagData) {
                        echo '<div class="bg-white rounded-xl border border-gray-200 p-6 hover:shadow-lg transition-all">
                                <div class="flex items-center justify-between mb-4">
                                    <span class="px-3 py-1 rounded-full bg-indigo-50 text-indigo-600 text-sm font-medium">
                                        ' . htmlspecialchars($tagData['nom']) . '
                                    </span>
                                    <div class="flex items-center gap-2">
                                        <button class="text-gray-400 hover:text-gray-500" onclick="openEditModal(' . $tagData['id_tag'] . ', \'' . htmlspecialchars($tagData['nom']) . '\')">
                                            <i class="fas fa-pencil"></i>
                                        </button>
                                        <button class="text-gray-400 hover:text-red-500" onclick="deleteTag(' . $tagData['id_tag'] . ')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                                <h3 class="font-semibold text-gray-900">' . htmlspecialchars($tagData['nom']) . '</h3>
                                <p class="text-sm text-gray-500 mt-1">Used in X courses</p>
                                <div class="mt-4">
                                    <div class="flex items-center gap-4 text-sm text-gray-500">
                                        <span class="flex items-center">
                                            <i class="fas fa-book mr-2"></i>
                                            X Courses
                                        </span>
                                        <span class="flex items-center">
                                            <i class="fas fa-users mr-2"></i>
                                            X Students
                                        </span>
                                    </div>
                                </div>
                            </div>';
                    }
                    ?>
                </div>
            </main>
        </div>
    </div>

    <!-- Add Tag Modal (Hidden by default) -->
    <div id="addTagModal" class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
            <!-- Modal Header -->
            <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                <h3 class="text-lg font-medium text-gray-900">Add New Tag</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-500">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="px-6 py-4">
                <form id="tagForm" onsubmit="handleSubmit(event)">
                    <!-- Tag Name Input -->
                    <div class="mb-4">
                        <label for="tagName" class="block text-sm font-medium text-gray-700 mb-2">
                            Tag Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               id="tagName"
                               name="tagName"
                               required
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                               placeholder="Enter tag name">
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200">
                        <button type="button"
                                onclick="closeModal()"
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Cancel
                        </button>
                        <button type="submit"
                                class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Add Tag
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Tag Modal (Hidden by default) -->
    <div id="editTagModal" class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
            <!-- Modal Header -->
            <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                <h3 class="text-lg font-medium text-gray-900">Edit Tag</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-500">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="px-6 py-4">
                <form id="editTagForm" onsubmit="handleEditSubmit(event)">
                    <!-- Tag Name Input -->
                    <div class="mb-4">
                        <label for="editTagName" class="block text-sm font-medium text-gray-700 mb-2">
                            Tag Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               id="editTagName"
                               name="editTagName"
                               required
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                               placeholder="Enter tag name">
                    </div>

                    <!-- Hidden Tag ID Input -->
                    <input type="hidden" id="editTagId" name="editTagId">

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200">
                        <button type="button"
                                onclick="closeModal()"
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Cancel
                        </button>
                        <button type="submit"
                                class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Update Tag
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('addTagModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('addTagModal').classList.add('hidden');
            document.getElementById('editTagModal').classList.add('hidden');
        }

        function openEditModal(tagId, tagName) {
            document.getElementById('editTagName').value = tagName;
            document.getElementById('editTagId').value = tagId;
            document.getElementById('editTagModal').classList.remove('hidden');
        }

        function handleSubmit(event) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);
            const tagName = formData.get('tagName');

            // Send data to the server to create a new tag
            fetch('addTag.php', {
                method: 'POST',
                body: JSON.stringify({ tagName }),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Tag added successfully!');
                    closeModal();
                    // Refresh the tag list
                    location.reload();
                } else {
                    alert('Error adding tag: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        function handleEditSubmit(event) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);
            const tagId = document.getElementById('editTagId').value;
            const newName = formData.get('editTagName');

            // Send data to the server to update the tag
            fetch('updateTag.php', {
                method: 'POST',
                body: JSON.stringify({ tagId, newName }),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Tag updated successfully!');
                    closeModal();
                    // Refresh the tag list
                    location.reload();
                } else {
                    alert('Error updating tag: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        function deleteTag(tagId) {
            if (confirm('Are you sure you want to delete this tag?')) {
                // Send data to the server to delete the tag
                fetch('deleteTag.php', {
                    method: 'POST',
                    body: JSON.stringify({ tagId }),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Tag deleted successfully!');
                        // Refresh the tag list
                        location.reload();
                    } else {
                        alert('Error deleting tag: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        }
    </script>
</body>
</html>
