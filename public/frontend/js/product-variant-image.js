/**
 * Product Variant Image Handler
 * Xử lý cập nhật ảnh sản phẩm khi chọn phân loại
 * Được tách riêng để tránh xung đột với các script khác
 */

(function() {
    'use strict';

    // Object để lưu trữ original images
    const originalImages = {};

    /**
     * Tìm container ảnh lớn của sản phẩm
     * @returns {HTMLElement|null}
     */
    function getLargeImageContainer() {
        return document.querySelector('.product-details-gallery-area .product-large-image-vertical') || 
               document.querySelector('.product-details-gallery-area .product-large-image') ||
               document.querySelector('.product-large-image-vertical') || 
               document.querySelector('.product-large-image');
    }

    /**
     * Tìm container ảnh thumbnail của sản phẩm
     * @returns {HTMLElement|null}
     */
    function getThumbnailContainer() {
        return document.querySelector('.product-details-gallery-area .product-image-thumb') ||
               document.querySelector('.product-image-thumb');
    }

    /**
     * Lưu tất cả ảnh gốc từ gallery
     */
    function storeOriginalImages() {
        const largeContainer = getLargeImageContainer();
        if (!largeContainer) {
            console.warn('⚠️ product-variant-image.js: Large container not found for storing originals');
            return;
        }

        const largeImages = largeContainer.querySelectorAll('.product-image-large-single');
        largeImages.forEach((imgContainer, index) => {
            const img = imgContainer.querySelector('img');
            if (img && img.src && !originalImages[index]) {
                originalImages[index] = img.src;
                console.log(`✓ Stored original image ${index}:`, img.src);
            }
        });
    }

    /**
     * Cập nhật ảnh sản phẩm khi chọn phân loại
     * @param {string} imageUrl - URL ảnh phân loại
     */
    function updateProductImage(imageUrl) {
        console.log('🎯 [variant-image] updateProductImage called with:', imageUrl);

        if (!imageUrl || imageUrl.trim() === '') {
            console.warn('⚠️ [variant-image] No image URL provided');
            return;
        }

        const largeContainer = getLargeImageContainer();
        if (!largeContainer) {
            console.error('❌ [variant-image] Large image container NOT FOUND!');
            return;
        }

        const largeImages = largeContainer.querySelectorAll('.product-image-large-single');
        console.log('🔍 [variant-image] Found large images:', largeImages.length);

        if (largeImages.length === 0) {
            console.error('❌ [variant-image] No large images found');
            return;
        }

        // Xóa active từ tất cả
        largeImages.forEach(img => img.classList.remove('active'));
        console.log('✓ [variant-image] Removed active class from all images');

        // Lấy ảnh đầu tiên (ảnh chính)
        const firstLarge = largeImages[0];
        const img = firstLarge.querySelector('img');

        if (!img) {
            console.error('❌ [variant-image] Image element not found in first large container');
            return;
        }

        // Store original nếu chưa store
        if (!originalImages[0] && img.src) {
            originalImages[0] = img.src;
            console.log('💾 [variant-image] Stored original image:', originalImages[0]);
        }

        // Cập nhật src
        const oldSrc = img.src;
        img.src = imageUrl;
        img.alt = 'Variant Image';

        console.log('🖼️ [variant-image] Image src updated:', {
            old: oldSrc,
            new: imageUrl
        });

        // Thêm/remove classes để force display
        firstLarge.classList.remove('d-none', 'invisible');
        firstLarge.classList.add('active', 'd-block', 'show');
        firstLarge.style.display = 'block !important';
        firstLarge.style.visibility = 'visible';
        firstLarge.style.opacity = '1';

        console.log('✓ [variant-image] Applied display styles');

        // Force repaint
        void firstLarge.offsetHeight;

        // Trigger lazyload nếu cần
        if (img.hasAttribute('data-src')) {
            img.src = imageUrl;
            img.removeAttribute('data-src');
            console.log('✓ [variant-image] Removed lazyload attribute');
        }

        // Xử lý Intersection Observer / LazyLoad
        if (typeof lazysize !== 'undefined') {
            lazysize.loader({
                elements: [img]
            });
            console.log('✓ [variant-image] Triggered lazysize loader');
        }

        console.log('✅ [variant-image] Image updated successfully');
    }

    /**
     * Restore ảnh gallery gốc
     */
    function restoreGalleryImage(imageIndex) {
        console.log('🔄 [variant-image] Restoring gallery image index:', imageIndex);

        const largeContainer = getLargeImageContainer();
        if (!largeContainer) {
            console.warn('⚠️ [variant-image] Large container not found');
            return;
        }

        const largeImages = largeContainer.querySelectorAll('.product-image-large-single');
        if (imageIndex >= largeImages.length) {
            console.warn('⚠️ [variant-image] Image index out of bounds');
            return;
        }

        const imgContainer = largeImages[imageIndex];
        const img = imgContainer.querySelector('img');

        if (!img) {
            console.error('❌ [variant-image] Image element not found');
            return;
        }

        // Restore original image
        if (originalImages[imageIndex]) {
            img.src = originalImages[imageIndex];
            console.log('✓ [variant-image] Restored original image:', originalImages[imageIndex]);
        }

        // Remove variant styles
        imgContainer.classList.remove('active');
        imgContainer.classList.add('d-none');
        imgContainer.style.display = '';
        imgContainer.style.visibility = '';
        imgContainer.style.opacity = '';

        console.log('✅ [variant-image] Gallery image restored');
    }

    /**
     * Initialize: Store original images khi DOM ready
     */
    function initialize() {
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', storeOriginalImages);
        } else {
            storeOriginalImages();
        }
        console.log('✅ [variant-image] Module initialized');
    }

    // Export functions to global scope
    window.ProductVariantImage = {
        updateProductImage: updateProductImage,
        restoreGalleryImage: restoreGalleryImage,
        storeOriginalImages: storeOriginalImages,
        getLargeImageContainer: getLargeImageContainer,
        getThumbnailContainer: getThumbnailContainer
    };

    // Initialize on page load
    initialize();
})();
