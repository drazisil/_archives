package com.drazisil.creativedimensions.block.material;

import net.minecraft.block.material.EnumPushReaction;
import net.minecraft.block.material.MapColor;
import net.minecraft.block.material.Material;

/**
 * Created by drazisil on 2/11/2017.
 */
public class MaterialPortalCreative  extends Material
{

    /**
     * Mobility information flag. 0 indicates that this block is normal, 1 indicates that it can't push other blocks, 2
     * indicates that it can't be pushed.
     */
    private EnumPushReaction mobilityFlag = EnumPushReaction.NORMAL;

    public MaterialPortalCreative(MapColor color)
    {
        super(color);
    }

    /**
     * Returns true if the block is a considered solid. This is true by default.
     */
/*
    public boolean isSolid()
    {
        return false;
    }
*/

    /**
     * Will prevent grass from growing on dirt underneath and kill any grass below it if it returns true
     */
    public boolean blocksLight()
    {
        return false;
    }

    /**
     * Returns if this material is considered solid or not
     */
    public boolean blocksMovement()
    {
        return false;
    }

    /**
     * This type of material can't be pushed, and pistons are blocked to move.
     */
    public Material setImmovableMobility()
    {
        this.mobilityFlag = EnumPushReaction.BLOCK;
        return this;
    }
}