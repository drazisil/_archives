package com.drazisil.creativedimensions.items;

import com.drazisil.creativedimensions.CreativeDimensions;
import com.drazisil.creativedimensions.block.BlockCreativePortal;
import net.minecraft.block.Block;
import net.minecraft.block.material.Material;
import net.minecraft.block.state.IBlockState;
import net.minecraft.creativetab.CreativeTabs;
import net.minecraft.entity.player.EntityPlayer;
import net.minecraft.item.Item;
import net.minecraft.item.ItemStack;
import net.minecraft.util.EnumActionResult;
import net.minecraft.util.EnumFacing;
import net.minecraft.util.EnumHand;
import net.minecraft.util.math.BlockPos;
import net.minecraft.world.World;

/**
 * Created by drazisil on 2/10/2017.
 */
public class ItemWand extends Item {
    // private final float speed;
    protected Item.ToolMaterial theToolMaterial;

    public ItemWand()
    {
        super();
        ToolMaterial material = ToolMaterial.DIAMOND;
        this.maxStackSize = 1;
        this.setMaxDamage(material.getMaxUses());
        this.setCreativeTab(CreativeTabs.TOOLS);
        // this.speed = material.getDamageVsEntity() + 1.0F;
        this.setUnlocalizedName(CreativeDimensions.MODID + ":wand");
    }

    /**
     * Called when a Block is right-clicked with this Item
     */
    public EnumActionResult onItemUse(ItemStack stack, EntityPlayer playerIn, World worldIn, BlockPos pos, EnumHand hand, EnumFacing facing, float hitX, float hitY, float hitZ)
    {
        if (!playerIn.canPlayerEdit(pos.offset(facing), facing, stack))
        {
            return EnumActionResult.FAIL;
        }
        else
        {
            IBlockState iblockstate = worldIn.getBlockState(pos);
            Block block = iblockstate.getBlock();

            if (facing != EnumFacing.DOWN && worldIn.isAirBlock(pos.up()))
            {
                // Is this a solid block?
                if (block.isBlockSolid(worldIn, pos, facing))
                {
                    block = new BlockCreativePortal(Material.PORTAL);
                    if (!worldIn.isRemote)
                    {
                        worldIn.setBlockState(pos, block.getDefaultState(), 11);
                        System.out.println("Block before: " + playerIn.worldObj.getBlockState(pos));
                    }
                    return EnumActionResult.FAIL;
                }
            }

            return EnumActionResult.PASS;
        }
    }

}

