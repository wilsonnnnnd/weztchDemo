<?php
/**
 * @var \App\View\AppView $this
 * @var array $params
 * @var string $message
 */
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="message success" style="color: red;font-size:20px" onclick="this.classList.add('hidden')"><?= $message ?></div>
