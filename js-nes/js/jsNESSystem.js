/*
 * This is the system board
 */
function jsNESSystem() {

}

jsNESSystem.prototype.POST = function() {
    if ((js6202) && (jsCart) && (jsROM)) {
        this.cpu = new js6202();
        this.cart = new jsCart();
        this.rom = new jsROM(this.cart);
        this.cpu.rom = this.rom;
        debug('SYSTEM: POST passed.');
        return true;
    } else {
        debug('SYSTEM: POST failed.');
        return false;

    }
};

/**
 * A soft or hard reset of the system.
 * @returns {Boolean}
 */
jsNESSystem.prototype.Reset = function()
{
    // Set P to 1 = true, B = true, I = true
    this.cpu.registers.P[0] = 52;
    
    this.cpu.registers.PC[0] = this.rom['FFFC'];
    this.cpu.registers.PC[0] = this.rom['FFFD'];
    return true;
};


jsNESSystem.prototype.run = function(maxCycles) {
    
    for (i = 0; i < maxCycles; i++){
        // Fetch
        
        // Decode
        
        // Execute
    }

return false;

};

/*
 * Utility functions
 */
function debug(data) {
    if (debugMode === true) {
        console.log(data);
    }
}
