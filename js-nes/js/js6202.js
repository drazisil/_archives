/*
 * The 6202 cpu object
 * @returns {Boolean}
 */
function js6202() {
    
    this.registers = {};
    /*
     * Instruction Register (IR) and Decode 
     * The Operation Code (OpCode) portion of the instruction is loaded into the 
     * Instruction Register from the Data Bus and is latched during the OpCode 
     * fetch  cycle. The OpCode is then decoded, along with timing and interrupt 
     * signals, to generate various control signals for program execution.
     * @type object
     */
    this.registers.IR = new Uint8Array(new ArrayBuffer(1));
    /*
     * Accumulator Register (A)
     * The Accumulator Register (A) is an 8-bit general purpose register which 
     * holds one of the operands and the result  of  arithmetic  and  logical  
     * operations.   Reconfigured  versions  of  this  processor  family  could  
     * have additional accumulators. 
     */
    this.registers.A = new Uint8Array(new ArrayBuffer(1));
    /*
     * Index Registers (X and Y)
     * There are two 8-bit Index Registers (X and Y) which may be used as general 
     * purpose registers or to provide an  index  value  for  calculation  of the  
     * effective  address. When  executing  an  instruction  with  indexed addressing, 
     * the microprocessor fetches the OpCode and the base address, and then 
     * modifies the address by adding the Index Register contents to the address 
     */
    this.registers.X = new Uint8Array(new ArrayBuffer(1));
    this.registers.Y = new Uint8Array(new ArrayBuffer(1));
    /*
     * Program Counter Register (PC)
     * The  16-bit  Program  Counter  Register  (PC)  provides  the  addresses  
     * which  are  used  to  step  the microprocessor  through  sequential  
     * program  instructions.   This  register  is  incremented  each  time  an 
     * instruction or operand is fetched from program memory.
     */
    this.registers.PC = new Uint8Array(new ArrayBuffer(2));
    /*
     * Stack Pointer Register (S)
     * The Stack Pointer Register (S) is an 8-bit register which is used to 
     * indicate the next available location in the stack memory area. It serves 
     * as the effective address in stack addressing modes as well as subroutine 
     * and interrupt processing.
     */
    this.registers.S = new Uint8Array(new ArrayBuffer(1));
    /*
     * Processor Status Register (P)
     * The  8-bit  Processor  Status  Register  (P)  contains  status  flags  
     * and  mode  select  bits.  The  Carry  (C), Negative (N), Overflow (V) 
     * and Zero (Z) status flags serve  to report the status of ALU operations. 
     * These status flags are tested with Conditional Branch instructions. 
     * The Decimal (D) and IRQB disable (I) are used as mode select flags. 
     * These flags are set by the program to change microprocessor operations. 
     * Bit 5 is available for a user status or mode bit. 
     */
    this.registers.P = new Uint8Array(new ArrayBuffer(1));
    
    this.flags = {};
    // Negative 1 = neg
    this.flags.N = 128;
    // Overflow 1 = true 
    this.flags.V = 64;
    // BRK command 1 = BRK, 0 = IRQB    
    this.flags.B = 16;
    // Decimal mode 1 = true
    this.flags.D = 8;
    // IRQB disable 1 = disable
    this.flags.I = 4;
    // Zero 1 = True
    this.flags.Z = 2;
    // Carry 1 = True
    this.flags.C = 1;
    return true;
}


