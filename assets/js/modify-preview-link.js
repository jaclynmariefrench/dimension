document.addEventListener('DOMContentLoaded', function () {
    console.log('DOM fully loaded and parsed');

    function modifyPreviewLink() {
        const buttons = document.querySelectorAll('a.components-button.has-icon');
        let previewButton = null;

        buttons.forEach(button => {
            if (button.getAttribute('aria-label') === 'View Page') {
                previewButton = button;
            }
        });

        if (previewButton) {
            const originalHref = previewButton.getAttribute('href');

            // Modify the href to place the hash before the last path segment
            const url = new URL(originalHref, document.baseURI); // Ensure base URI for relative URLs
            const pathSegments = url.pathname.split('/').filter(segment => segment.length > 0); // Filter empty segments
            const lastSegment = pathSegments.pop(); // Last segment for the hash
            const modifiedHref = `${url.origin}/${pathSegments.join('/')}/#${lastSegment}`;

            previewButton.setAttribute('href', modifiedHref);

            previewButton.addEventListener('click', function (event) {
                event.preventDefault();
                window.open(modifiedHref, '_blank');
            }, { once: true }); // Ensure the event listener is added only once
        } 
    }

    // Polling function to check for the button at intervals
    function pollForButton() {
        modifyPreviewLink();
        if (!document.querySelector('a.components-button.has-icon[aria-label="View Page"]')) {
            setTimeout(pollForButton, 1000); // Check every second
        }
    }

    // Initial call to handle cases where the button is already in the DOM
    pollForButton();
});
