wp.domReady(() => {
    const { getBlockTypes, unregisterBlockStyle } = wp.blocks;

    getBlockTypes().forEach((block) => {
        const styles = block.styles || [];
        styles.forEach((style) => {
            unregisterBlockStyle(block.name, style.name);
        });
    });
});