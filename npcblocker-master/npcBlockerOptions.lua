 
-- Copyright (C) 2014 Joseph W Becher

-- This program is free software: you can redistribute it and/or modify
-- it under the terms of the GNU General Public License as published by
-- the Free Software Foundation, either version 3 of the License, or
-- (at your option) any later version.

-- This program is distributed in the hope that it will be useful,
-- but WITHOUT ANY WARRANTY; without even the implied warranty of
-- MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
-- GNU General Public License for more details.

-- You should have received a copy of the GNU General Public License
-- along with this program.  If not, see <http://www.gnu.org/licenses/>.


-- create a interface options panel
npcBlocker = {};
 npcBlocker.panel = CreateFrame( "Frame", "npcBlockerPanel", UIParent );
 -- Register in the Interface Addon Options GUI
 -- Set the name for the Category for the Options Panel
 npcBlocker.panel.name = "npcBlocker";
 -- Add the panel to the Interface Options
 InterfaceOptions_AddCategory(npcBlocker.panel);
 
 -- Make a child panel
 npcBlocker.childpanel = CreateFrame( "Frame", "npcBlockerChild", npcBlocker.panel);
 npcBlocker.childpanel.name = "npcBlocker";
 -- Specify childness of this panel (this puts it under the little red [+], instead of giving it a normal AddOn category)
 npcBlocker.childpanel.parent = npcBlocker.panel.name;
 -- Add the child to the Interface Options
 InterfaceOptions_AddCategory(npcBlocker.childpanel);