// Product Gallery Image Sync Script
// IMPORTANT: This script should NOT interfere with variant image changes
// The product_single.blade.php handles variant image updates
document.addEventListener('DOMContentLoaded', function() {
    // Support for NEW gallery structure (.product-image-thumb-single / .product-image-large-single)
    const thumbsContainerNew = document.querySelector('.product-image-thumb');
    const largeContainerNew = document.querySelector('.product-large-image-vertical') || 
                              document.querySelector('.product-large-image');
    
    if (thumbsContainerNew && largeContainerNew) {
        const thumbsNew = thumbsContainerNew.querySelectorAll('.product-image-thumb-single');
        const largesNew = largeContainerNew.querySelectorAll('.product-image-large-single');
        
        console.log('✓ New gallery structure detected:', {
            thumbs: thumbsNew.length,
            larges: largesNew.length
        });
        
        // IMPORTANT: Do NOT add click handlers here
        // The handlers are already set up in product_single.blade.php
        // This script is just for logging and verification
        if (thumbsNew.length === 0 || largesNew.length === 0) {
            console.warn('⚠️ Gallery structure exists but images count is 0');
        }
    } else {
        console.log('ℹ️ New gallery structure not found on this page (might be quickview or other page)');
    }
    
    // Support for OLD gallery structure (.tf-product-media-thumbs / .tf-product-media-main)
    // Legacy support if needed
    const thumbsContainer = document.querySelector('.tf-product-media-thumbs');
    const mainContainer = document.querySelector('#gallery-swiper-started');
    
    if (thumbsContainer && mainContainer) {
        console.log('ℹ️ Old gallery structure detected (legacy)');
        // Get Swiper instances after they're initialized
        setTimeout(function() {
            const thumbsSwiper = thumbsContainer.swiper;
            const mainSwiper = mainContainer.swiper;
            
            if (thumbsSwiper && mainSwiper) {
                console.log('✓ Legacy Swiper instances found');
                // Click on thumbnail to sync with main
                thumbsSwiper.on('click', function(event) {
                    const clickedIndex = thumbsSwiper.clickedIndex;
                    if (clickedIndex !== undefined) {
                        mainSwiper.slideTo(clickedIndex);
                    }
                });
                
                // Also listen to main swiper changes to update thumbnail
                mainSwiper.on('slideChange', function() {
                    const activeIndex = mainSwiper.activeIndex;
                    thumbsSwiper.slideTo(activeIndex);
                });
            }
        }, 500);
    } else {
        console.log('ℹ️ Old gallery structure not found (expected, using new structure)');
    }
});

