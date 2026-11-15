<?php

function sanitazion($input)
{
  return htmlspecialchars(trim($input));
}