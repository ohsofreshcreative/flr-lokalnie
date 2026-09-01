import domReady from '@wordpress/dom-ready';

domReady(() => {
  const showBlockAppenders = () => {
    document.querySelectorAll('.block-list-appender, .block-editor-default-block-appender').forEach((appender) => {
      const hasBlockPrompt = appender.textContent?.includes('Wciśnij') || appender.textContent?.includes('Type /');

      if (!hasBlockPrompt) {
        return;
      }

      appender.style.setProperty('display', 'flex', 'important');
      appender.style.setProperty('visibility', 'visible', 'important');
      appender.style.setProperty('opacity', '1', 'important');
      appender.style.setProperty('min-height', '64px');
      appender.style.setProperty('margin', '18px 0 4px', 'important');
      appender.style.setProperty('border', '2px dashed #b8c7d1', 'important');
      appender.style.setProperty('border-radius', '8px', 'important');
      appender.style.setProperty('background', '#f7fbfd', 'important');

      appender.querySelectorAll('button, [role="button"]').forEach((button) => {
        button.style.setProperty('display', 'flex', 'important');
        button.style.setProperty('visibility', 'visible', 'important');
        button.style.setProperty('opacity', '1', 'important');
      });
    });
  };

  showBlockAppenders();
  new MutationObserver(showBlockAppenders).observe(document.body, {
    childList: true,
    subtree: true,
  });
});


