<?php


if (have_rows('parent_group')) :
    while (have_rows('parent_group')) : the_row();

        // Loop over sub group rows.
        if (have_rows('child_group ')) :
            while (have_rows('child_group ')) : the_row();

                // Loop over sub child group rows.
                if (have_rows('sub_child_group')) :
                    while (have_rows('sub_child_group')) : the_row();

                        // content 
                        $sub_child_title = get_sub_field('sub_child_title');

                    endwhile;
                endif; // sub child 
            endwhile;
        endif; // child
    endwhile;
endif; // parent